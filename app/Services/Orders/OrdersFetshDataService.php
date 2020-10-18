<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Models\Address;
use App\Services\BaseService;

class OrdersFetshDataService extends BaseService
{
    protected $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    protected $paginate = 6;
    protected $view = 'list';

    public function index($request)
    {
        $this->setView($request->view ?? null);
        return $this->identify($request)->index(
            (object) array_merge(
                $request->all(),
                [
                    'status' => ($request->status ?? false) && in_array($request->status, $this->orderStatuses) ? $request->status : false,
                    'search' => $request->search ?? false,
                    'view' => $this->view,
                    'paginate' => $this->paginate,
                ]
            )
        );
    }
    public function show($request, $id)
    {

        $relationsLoded = ['reciver', 'reciver.city', 'reciver.address', 'shipping'];
        if ($request->adminType == 'manager') {
            $relationsLoded = array_merge($relationsLoded, ['customer', 'customer.city', 'customer.address']);
        }
        $orderData = Order::with($relationsLoded)->where('id', $id)->first();


        $orderData->shipping->final_price = ($request->adminType == 'manager') ?
            $orderData->shipping->total_price :
            $orderData->shipping->customer_price;

        return view(
            'order.show.' . $request->adminType,
            [
                'order' => $orderData,
            ]
        );
    }

    private function setView($value = null)
    {
        if ($value == null && session('view')) {
            $this->view = session('view');
        } else {
            if ($value == 'grid' || $value == 'list') {
                $this->view = $value;
                session(['view' => $this->view]);
            }
        }
        $this->setPaginate();
        return $this;
    }
    private function setPaginate()
    {
        $this->paginate = 6;
        if ($this->view == 'list') {
            $this->paginate = 12;
        }
    }

    public function print($request)
    {
        $tables = [
            'customer' => ['id', 'fullname', 'phone', 'city_name', 'city_name_en', 'governorate_name', 'governorate_name_en'],
            'reciver' => ['id', 'fullname', 'phone', 'city_name', 'city_name_en', 'governorate_name', 'governorate_name_en'],
            'shipping' => ['order_id', 'total_price', 'charge_on', 'order_num', 'total_weight']
        ];
        if ($request->adminType == 'manager')
            $order = Order::select('orders.*')
                ->join('shippings as s', 's.order_id', '=', 'orders.id')
                ->join('customers as c', 'c.id', '=', 'orders.customer_id')
                ->join('recivers as r', 'r.id', '=', 'orders.reciver_id')
                ->join('cities as c_c', 'c_c.id', '=', 'c.city_id')
                ->join('cities as c_r', 'c_r.id', '=', 'r.city_id')
                ->join('governorates as g_c', 'g_c.id', '=', 'c.governorate_id')
                ->join('governorates as g_r', 'g_r.id', '=', 'r.governorate_id')
                ->selectRaw('CONCAT_WS(",",c.id,c.fullname,c.phone,c_c.city_name,c_c.city_name_en,g_c.governorate_name,g_c.governorate_name_en) as customer')
                ->selectRaw('CONCAT_WS(",",r.id,r.fullname,r.phone,c_r.city_name,c_r.city_name_en,g_r.governorate_name,g_r.governorate_name_en) as reciver')
                ->selectRaw('CONCAT_WS(",",s.order_id,s.total_price,s.charge_on,s.order_num,s.total_weight) as shipping')
                ->where('orders.id', $request->orderId)->first();

            $order->date = $order->created_at->format('Y-m-d');

            foreach ($tables as $table => $colmuns) {
                $order->$table = (object) (array_combine($colmuns, explode(',', $order->$table)));
            }

            $localeIsAr = app()->getLocale() == 'ar';
            $order->customer->city = $localeIsAr ? $order->customer->city_name : $order->customer->city_name_en;
            $order->customer->governorate = $localeIsAr ? $order->customer->governorate_name : $order->customer->governorate_name_en;
            $order->reciver->city = $localeIsAr ? $order->reciver->city_name : $order->reciver->city_name_en;
            $order->reciver->governorate = $localeIsAr ? $order->reciver->governorate_name : $order->reciver->governorate_name_en;

            $addresses = Address::get();

            $addresses->map(function($address) use($order) {
                if($address->addressable_type == "App\\Models\\Customer" && $address->addressable_id == $order->customer->id){
                    $order->customer->address = $address;
                }
                if($address->addressable_type == "App\\Models\\Reciver" && $address->addressable_id == $order->reciver->id){
                    $order->reciver->address = $address;
                }
            });

            $order->userCanOpenOrder  = trans('site.order_print_user_can_open_order_'. $order->user_can_open_order);
            $order->charge_on =trans('site.order_print_charge_on_'. $order->shipping->charge_on);
            // $order->get_price = $order->shipping->total_price != 0 ? trans('site.order_print_true'):trans('site.order_print_false');
            // $order->get_price_viza = $order->shipping->total_price == 0 ? trans('site.order_print_true'):trans('site.order_print_false');


            // return $order;
            return view('order.print', ['order' => $order]);
        return abort(404);
    }

}
