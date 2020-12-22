<?php
namespace App\Http\Traits;

use App\Models\Order;

trait OrderTrait
{
    protected function orderPath($request, $page)
    {
        $data = $request->validated();

        if (isset($data['customer'])) {
            session(['customer' => $data['customer']]);
            if (isset($data['address'])) {
                session(['customerAddress' => $data['address']]);
            }

        }
        if (isset($data['reciver'])) {
            session(['reciver' => $data['reciver']]);
            if (isset($data['address'])) {
                session(['reciverAddress' => $data['address']]);
            }

        }
        session(['page' => $page]);

        return redirect()->route('order.create', ['page' => $page]);
    }

    protected function setOrderNumberUnique($orderId)
    {
        return 3018 . ($orderId + 4);
    }
    /**
     * store order data in orders table
     *
     * @param array $data
     * @return void
     */
    private function storeOrderData(array $data)
    {
        $order = Order::make($data);
        $order->customer()->associate($this->customer);
        $order->reciver()->associate($this->reciver);
        $order->save();

        $this->order = $order;
    }
    /**
     * store order data in shippings table
     *
     * @param array $data
     * @return void
     */
    private function storeOrderShippingData(array $data)
    {
        $this->order->shipping()->create(array_merge(
            $data,
            ['order_num' => $this->setOrderNumberUnique($this->order->id)]
        ));
    }


}
