<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\BaseService;

class CustomerOrderFetshDataService extends BaseService
{
    const IMAGE_PATH = 'orders/';

    private $paginate = 6;
    private $view = 'list';

    public function handle($admin)
    {

        $orders = Order::select('id', 'reciver_id', 'customer_id', 'created_at', 'status')->with(
            [
                'shipping' => function ($query) {
                    $query->selectRaw('id,order_id,charge_on,charge_price,order_num')
                        ->selectRaw('IF(charge_on="sender" ,price - charge_price ,price) AS price');
                },

                'reciver' => function ($query) {
                    $query->select('id', 'phone', 'fullname', 'city_id');
                },
                'reciver.city',

            ]
        )->where('customer_id', $admin->customer->id)
            ->paginate($this->paginate);

        //  return $orders;


        return view(
            'order.index.customer',
            [
                'orders' => $orders,
                'view'   => $this->view
            ]
        );
    }
    public function setView($value = null)
    {
        if($value == null && session('view')){
            $this->view = session('view');
        }else{
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
}
