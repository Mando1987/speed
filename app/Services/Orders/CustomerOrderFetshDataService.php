<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\BaseService;

class CustomerOrderFetshDataService extends BaseService
{
    const IMAGE_PATH = 'orders/';

    public function handle($admin)
    {

        $orders = Order::select('id', 'reciver_id' , 'customer_id', 'created_at', 'status')->with(
            [
                'shipping' => function($query){
                    $query->selectRaw('id,order_id,charge_on,charge_price,order_num')
                          ->selectRaw('IF(charge_on="sender" ,price - charge_price ,price) AS price');
                },

                'reciver' => function ($query) {
                    $query->select('id', 'phone', 'fullname', 'city_id');
                },
                'reciver.city' ,

            ]
        )->where('customer_id', $admin->customer->id)
         ->paginate(12);

        //  return $orders;


        return view('order.index.customer', ['orders' => $orders]);
    }
}
