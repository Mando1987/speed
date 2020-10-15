<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Repositories\BaseRepository;
use App\Http\Traits\Orders\OrderGetAll;
use App\Http\Traits\OrderTrait;
use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Reciver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    use OrderTrait, OrderGetAll;

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

    protected $paginate = 12;
    protected $view = 'list';
    private $order;
    private $request;
    public function __construct(Order $order, Request $request)
    {
        $this->order = $order;
        $this->request = $request;
    }

    public function getAll()
    {
        $orders = $this->order::withRealtionsTables()
            ->whereAdminIsCustomer()->latest()->paginate($this->request->paginate ?? $this->paginate);

        return view(
            'order.index.' . $this->request->adminType,
            [
                'orders' => $orders,
                'view'   => $this->request->view,
                'status' => $this->request->status ?? 'all',
                'search' => $this->request->search,
            ]
        );

    }
    public function getById()
    {

    }
    public function store(OrderStoreFormRequestInterface $request)
    {

        if (session('page') == 1) {

            return $this->orderPath($request, 2);
        }

        if ($request->adminType == 'manager' && session('page') == 2 && session('customer')) {
            return $this->orderPath($request, 3);
        }

        if (session('page') == 2 && session('reciver') ||
            session('page') == 3 && session('customer') && session('reciver')) {

            try {

                DB::beginTransaction();
                $data = $request->validated();

                if ($request->adminType == 'customer') {
                    $customer = $request->adminId;
                } else {
                    if (!array_key_exists('chooseType', $data['customer'])) {
                        $customer = Customer::create($data['customer']);
                        $customer->address()->create($data['customerAddress']);
                    } else {
                        $customer = $data['customer']['existingId'];
                    }
                }

                if (!array_key_exists('chooseType', $data['reciver'])) {

                    $reciver = Reciver::make($data['reciver']);
                    $reciver->customer()->associate($customer)->save();
                    $reciver->address()->create($data['reciverAddress']);
                } else {
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
    public function update()
    {

    }
    function print() {
        $tables = [
            'customer' => ['id', 'fullname', 'phone', 'city_name', 'city_name_en', 'governorate_name', 'governorate_name_en'],
            'reciver' => ['id', 'fullname', 'phone', 'city_name', 'city_name_en', 'governorate_name', 'governorate_name_en'],
            'shipping' => ['order_id', 'total_price', 'charge_on', 'order_num', 'total_weight'],
        ];
        if ($this->request->adminType == 'manager') {
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
                ->where('orders.id', $this->request->orderId)->first();
        }

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

        $addresses->map(function ($address) use ($order) {
            if ($address->addressable_type == "App\\Models\\Customer" && $address->addressable_id == $order->customer->id) {
                $order->customer->address = $address;
            }
            if ($address->addressable_type == "App\\Models\\Reciver" && $address->addressable_id == $order->reciver->id) {
                $order->reciver->address = $address;
            }
        });

        $order->userCanOpenOrder = trans('site.order_print_user_can_open_order_' . $order->user_can_open_order);
        $order->charge_on = trans('site.order_print_charge_on_' . $order->shipping->charge_on);
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
