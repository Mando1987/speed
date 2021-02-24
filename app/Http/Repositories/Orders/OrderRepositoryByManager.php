<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\CreateOrderTrait;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\ViewSettingTrait;
use App\Models\Customer;
use App\Models\Order;
use App\Notifications\Telegram\NotifyAddNewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepositoryByManager implements OrderRepositoryInterface
{
    use OrderTrait, FormatedResponseData, ViewSettingTrait, CreateOrderTrait;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function getAll(Request $request)
    {
        $this->setViewSetting();
        $orders = $this->order->WithDefaultRealtions()
            ->WithCustomerRelationship()
            ->latest()
            ->paginate($this->paginate);
        return response(view(
            $this->indexViewPath,
            [
                'orders' => $orders,
                'view' => $this->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        ));
    }
    public function showById(Request $request, $id)
    {
        return $this->getOrderFullDetails($id, 'show.manager');
    }
    public function printInvoice(Request $request)
    {
        return $this->getOrderFullDetails($request->orderId, 'print');
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

        } catch (\Exception $ex) {

            DB::rollback();
            // return $this->responseJson('failed');
        }
    }
    private function getOrderFullDetails(int $orderId, string $view)
    {
        $orderData = $this->order->with(['reciver', 'shipping', 'customer'])
            ->whereId($orderId)
            ->first();
        if ($orderData) {
            $this->setOrderRelationship($orderData, 'reciver');
            $this->setOrderRelationship($orderData, 'customer');
        }
        return view('order.' . $view, ['order' => $orderData]);
    }
    public function create(Request $request)
    {
        $customers = Customer::all();
        return view('order.create.createByManager', [
            'customers' => $customers,
            'userData' => $request->all(),
        ]);
    }

    public function store(OrderStoreFormRequest $request)
    {
        $page = session('orderData')['page'];
        if ($page == 'order') {
            try {
                $data = $request->validated();
                DB::beginTransaction();
                $customerId = $this->storeCustomerData($data['customer']);
                $reciverId = $this->storeReciverData($data['reciver'], $customerId);
                $order = $this->storeOrderData(array_merge($data['order'], ['status' => 'under_preparation']), $customerId, $reciverId);
                $this->createOrderStatusFirstStep($order);
                $this->storeOrderShippingData($data['shipping'], $order->id);
                DB::commit();
                $order->notify(new NotifyAddNewOrder($order));
                $this->forgetOrderDataFromSession();
                return (new AlertFormatedDataJson('validateOrder'))->alertBody(
                    'includes.alerts.order',
                    trans('site.added')
                )->formatedData();

            } catch (\Exception $ex) {
                DB::rollback();
                \Log::error($ex->getMessage());
                return AlertFormatedDataJson::alertServerError('order.create');
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
    }

}
