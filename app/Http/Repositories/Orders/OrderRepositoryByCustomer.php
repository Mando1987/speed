<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\ViewSettingTrait;
use App\Models\Order;
use Illuminate\Http\Request;
use NotificationChannels\Telegram\Telegram;

class OrderRepositoryByCustomer implements OrderRepositoryInterface
{
    use OrderTrait, FormatedResponseData,ViewSettingTrait;

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
}
