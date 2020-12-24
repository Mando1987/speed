<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\CreateOrderInterface;
use App\Http\Interfaces\OrderRepositoryAbstract;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\BaseRepository;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Services\ProviderClass;
use App\Http\Traits\Orders\OrderGetAll;
use App\Http\Traits\OrderTrait;
use App\Models\Address;
use App\Models\City;
use App\Models\Customer;
use App\Models\Governorate;
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

    protected $paginate;
    protected $view;
    private $order;
    private $city;
    private $governorate;
    private $address;
    private $cities_id = [];
    private $governorates_id = [];

    public function __construct(Order $order, Request $request)
    {
        $this->order = $order;
    }
    public function getAll(Request $request)
    {


    }
    public function showById(Request $request, $id)
    {
        $query = $this->order::with(['reciver', 'shipping']);
        $query = $request->adminIsManager ? $query->with(['customer']) : $query;
        $orderData = $query->whereId($id)->where(function ($query) use ($request) {
            return $query->when($request->adminIsCustomer, function ($q) use ($request) {
                return $q->whereCustomerId($request->adminId);
            });
        })->first();

        if ($orderData) {
            $this->cities_id[] = $orderData->reciver->city_id;
            $this->governorates_id[] = $orderData->reciver->governorate_id;
            $request->adminIsManager ?
            ($this->cities_id[] = $orderData->customer->city_id)
            && ($this->governorates_id[] = $orderData->customer->governorate_id)
            && $this->setCityRelationship($orderData, 'customer')
            && $this->setAddressRelationship($orderData, 'customer')
            && $this->setGovernorateRelationship($orderData, 'customer')
            : false;
            $this->setCityRelationship($orderData, 'reciver');
            $this->setAddressRelationship($orderData, 'reciver');
            $this->setGovernorateRelationship($orderData, 'reciver');
        }

        return view('order.show.' . $request->adminType, ['order' => $orderData]);
    }

    function print(Request $request)
    {

        $orderData = $this->order::with(['reciver', 'shipping', 'customer'])
            ->whereId($request->orderId)->where(function ($query) use ($request) {
            return $query->when($request->adminIsCustomer, function ($q) use ($request) {
                return $q->whereCustomerId($request->adminId);
            });
        })->first();

        if ($orderData) {
            $this->cities_id[] = $orderData->reciver->city_id;
            $this->governorates_id[] = $orderData->reciver->governorate_id;
            if ($request->adminIsManager) {
                $this->cities_id[] = $orderData->customer->city_id;
                $this->governorates_id[] = $orderData->customer->governorate_id;
                $this->setCityRelationship($orderData, 'customer');
                $this->setAddressRelationship($orderData, 'customer');
                $this->setGovernorateRelationship($orderData, 'customer');
            }
            $this->setCityRelationship($orderData, 'reciver');
            $this->setAddressRelationship($orderData, 'reciver');
            $this->setGovernorateRelationship($orderData, 'reciver');
        }
        return view('order.print', ['order' => $orderData]);

    }




    public function editOrder(Request $request)
    {
        $editType = [
            'edit_customer' => 'customer',
            'edit_reciver' => 'reciver',
            'edit_order' => 'order',
        ];

        $order = $this->order::find($request->order_id);
        if ($order) {
            if (array_key_exists($request->edit_type, $editType)) {
                $type = $editType[$request->edit_type];
                if ($type == 'order') {

                    session(
                        ['reciver' => [
                            'chooseType' => 'exists',
                            'existingId' => $order->reciver->id],
                        ]
                    );

                    return view('order.edit.' . $type, [
                        'userData' => [
                            'order' => $order,
                            'shipping' => $order->shipping,
                        ], 'adminIsManager' => $request->adminIsManager,
                    ]);
                }
                return view('order.edit.' . $type, [
                    'userData' => [
                        $type => $order->$type,
                        'address' => $order->$type->address,
                    ], 'city_id' => $order->$type->city_id,
                ]
                );
            }
        }
        return abort(404);

    }

    public function update(OrderEditFormRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $order = Order::find($id);

            if ($order) {
                $order->update($data['order']);
                $order->shipping()->update($data['shipping']);
            }
            DB::commit();

            $this->forgetOrderData();
            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_EDITED]);
            return $this->responseJson('ok', 200, route('order.index'));

        } catch (\Exception $ex) {

            DB::rollback();
            return $this->responseJson('failed');
        }
    }


}
