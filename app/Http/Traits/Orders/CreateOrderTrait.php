<?php
namespace App\Http\Traits\Orders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Reciver;
use App\Models\Shipping;

trait CreateOrderTrait
{
    /**
     * store customer data in customers table
     * @param array $data
     * @return integer customer_id
     */
    private function storeCustomerData(array $data): int
    {
        if ($data['type'] == 'new') {
            $customer = Customer::create($data['data']);
            $customer->address()->create($data['address']);
            $customerId = $customer->id;
        } else {
            $customerId = $data['data']['id'];
        }
        return $customerId;
    }
    /**
     * store new reciver in recivers table
     * @param array $data
     * @param integer $customerId
     * @return integer reciver_id
     */
    private function storeReciverData(array $data, int $customerId): int
    {
        if ($data['type'] == 'new') {
            $reciver = Reciver::make($data['data']);
            $reciver->customer()->associate($customerId)->save();
            $reciver->address()->create($data['address']);
            $reciverId = $reciver->id;
        } else {
            $reciverId = $data['data']['id'];
        }
        return $reciverId;
    }
    /**
     * store order data in orders table
     * @param array $data
     * @param integer $customerId
     * @param integer $reciverId
     * @return Order Order
     */
    private function storeOrderData(array $data, int $customerId, int $reciverId): Order
    {
        $order = Order::make($data);
        $order->customer()->associate($customerId);
        $order->reciver()->associate($reciverId);
        $order->save();
        return $order;
    }
    /**
     * store order shipping in shippings table
     * @param array $data
     * @param integer $orderId
     * @return void
     */
    private function storeOrderShippingData(array $data, int $orderId) :void
    {
        $shipping = Shipping::make(array_merge(
            $data,
            ['order_num' => $this->setOrderNumberUnique($orderId)]
        ));
        $shipping->order()->associate($orderId);
        $shipping->save();
    }
    /**
     * set unique order number
     * @param integer $orderId
     * @return integer order number
     */
    private function setOrderNumberUnique(int $orderId): int
    {
        return 3018 . ($orderId + 4);
    }
    /**
     * forget OrderData From Session
     *
     * @return void
     */
    private function forgetOrderDataFromSession()
    {
       session()->forget('orderData');
    }
    /**
     * create new step status for existing order
     *
     * @param \App\Models\Order $order
     * @param string $status
     *
     * @return void
     */
    private function createOrderStatusFirstStep(Order $order , $status = 'under_preparation'):void
    {
       $order->orderStatuses()->create(['status' => $status , 'step' => 'possibility_of_delivery']);
    }

}
