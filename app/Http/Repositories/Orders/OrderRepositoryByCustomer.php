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
use App\Models\Order;
use App\Models\Reciver;
use App\Notifications\Telegram\NotifyAddNewOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepositoryByCustomer implements OrderRepositoryInterface
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
            ->WithReciverCityRelationship()
            ->latest()
            ->paginate($this->paginate);
        return view(
            $this->indexViewPath,
            [
                'orders' => $orders,
                'view' => $this->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        );
    }
    public function showById(Request $request, $id)
    {
        return $this->getOrderFullDetails($id, 'show.customer');
    }
    public function printInvoice(Request $request)
    {
        return $this->getOrderFullDetails($request->orderId, 'print', ['customer']);
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
    }

    private function getOrderFullDetails(int $orderId, string $view, array $addRelation = [])
    {
        $orderData = $this->order::with(array_merge(['reciver', 'shipping'], $addRelation))
            ->whereId($orderId)
            ->whereCustomerId(request()->adminId)
            ->first();
        if ($orderData) {
            $this->setOrderRelationship($orderData, 'reciver');
        }
        return view('order.' . $view, ['order' => $orderData]);
    }

    public function create(Request $request)
    {
        $recivers = Reciver::select('id', 'fullname')->whereCustomerId($request->adminId)->get();
        return view('order.create.createByCustomer', [
            'recivers' => $recivers,
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
                $customerId = $request->adminId;
                $reciverId = $this->storeReciverData($data['reciver'], $customerId);
                $order = $this->storeOrderData(array_merge($data['order'], ['status' => 'under_review']), $customerId, $reciverId);
                $this->createOrderStatusFirstStep($order, 'under_review');
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
                Log::error($ex->getMessage());
                return AlertFormatedDataJson::alertServerError('order.create');
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
    }
}
