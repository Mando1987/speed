<?php
namespace App\Http\Repositories\Orders;

use App\Models\Order;
use App\Models\Reciver;
use App\Models\Customer;
use App\Http\Traits\OrderTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Repositories\BaseRepository;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    use OrderTrait;

    public $route = 'order.index';
    protected $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    private $searchColumns = [
        'recivers.fullname',
        'recivers.phone',
        'shippings.order_num',
        'cities.city_name',
        'cities.city_name_en',
        'customers.fullname',
        'customers.phone',
    ];

    protected $paginate = 6;
    protected $view = 'list';
    public function getAll(Request $request){
        $this->setView($request->view ?? null);
        $request->merge(
            ['status' => ($request->status ?? false) && in_array($request->status, $this->orderStatuses) ? $request->status : false,
                    'search' => $request->search ?? false,
                    'view' => $this->view,
                    'paginate' => $this->paginate,
            ]
        );
        //return $request;
        $orders = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
        ->join('customers', 'customers.id', '=', 'orders.customer_id')
        ->join('recivers', 'recivers.id', '=', 'orders.reciver_id')
        ->join('cities', 'cities.id', '=', 'customers.city_id')

       ->select('cities.*', 'orders.id', 'orders.reciver_id', 'orders.customer_id', 'orders.created_at', 'orders.status')
        ->addSelect('customers.id as customer_id', 'customers.fullname as customer_fullname', 'customers.phone as customer_phone', 'customers.city_id')
        ->addSelect('recivers.id as reciver_id', 'recivers.fullname as reciver_fullname')
        ->selectRaw('shippings.id,shippings.order_id,shippings.order_num,shippings.total_price')

        ->where(function ($query) use ($request) {
            return $query->when($request->search, function ($qsearch) use ($request) {

                foreach ($this->searchColumns as $key) {
                    $columns = $qsearch->orWhere($key, 'LIKE', "%{$request->search}%");
                }
                return $columns;
            })
                ->when($request->status, function ($qstatus) use ($request) {
                    return $qstatus->where('status', $request->status);
                });
        })
        ->latest()
        ->paginate($request->paginate);

        foreach ($orders as $index => &$order) {
            $order->city = app()->getLocale() == 'ar' ? $order->city_name:$order->city_name_en;
            $order->date = $order->created_at->format('Y-m-d');
            $order->getStatus = trans('site.order_status_' . $order->status);
        }
    return view(
        'order.index.manager',
        [
            'orders' => $orders,
            'view' => $request->view,
            'status' => $request->status ?? 'all',
            'search' => $request->search,
        ]
    );

    }
    public function getById(){

    }
    public function store(OrderStoreFormRequestInterface $request){

        if (session('page') == 1) {

            return $this->orderPath($request, 2);
        }

        if ($request->adminType =='manager' && session('page') == 2 && session('customer')) {
            return $this->orderPath($request, 3);
        }

        if (session('page') == 2 && session('reciver') ||
            session('page') == 3 && session('customer') && session('reciver')) {

            try {

                DB::beginTransaction();
                $data = $request->validated();

                if($request->adminType =='customer'){
                   $customer = $request->adminId;
                }else{
                    if(!array_key_exists('chooseType', $data['customer'])){
                        $customer = Customer::create($data['customer']);
                        $customer->address()->create($data['customerAddress']);
                    }else{
                        $customer = $data['customer']['existingId'];
                    }
                }

                if(!array_key_exists('chooseType', $data['reciver'])){

                    $reciver = Reciver::make($data['reciver']);
                    $reciver->customer()->associate($customer)->save();
                    $reciver->address()->create($data['reciverAddress']);
                }else{
                    $reciver = $data['reciver']['existingId'];
                }


                $order = Order::make($data['order']);
                $order->customer()->associate($customer);
                $order->reciver()->associate($reciver);
                $order->save();

                $order->shipping()->create(array_merge(
                    $request->validated()['shipping'],
                    ['order_num' => $this->setOrderNumberUnique($order->id)]
                ));
                DB::commit();

                $this->forgetOrderData();
                $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
                return $this->path($this->route);
            } catch (\Exception $ex) {

                DB::rollback();
                $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

                dd($ex->getMessage());
                return back();
            }
        }
    }
    public function update(){

    }
    public function print(Request $request){
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

            $addresses = \App\Models\Address::get();

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
        //$this->setPaginate();
       // return $this;
    }



}