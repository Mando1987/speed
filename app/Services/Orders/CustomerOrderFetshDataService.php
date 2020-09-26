<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\BaseService;

class CustomerOrderFetshDataService extends BaseService
{
    const IMAGE_PATH = 'orders/';
    private $paginate = 6;
    private $view = 'list';
    private $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];

    public function handle($request)
    {
        $this->setView($request->view ?? null);
        $status = ($request->status ?? false) && in_array($request->status, $this->orderStatuses) ? $request->status : false;
        $search = $request->search ?? false;

        // dd($search);

        // $orders = Order::select('id', 'reciver_id', 'customer_id', 'created_at', 'status')->with(
        //     [
        //         'shipping' => function ($query) {
        //             $query->selectRaw('id,order_id,charge_on,charge_price,order_num')
        //                 ->selectRaw('IF(charge_on="sender" ,price - charge_price ,price) AS price');
        //         },

        //         'reciver' => function ($query) {
        //             $query->select('id', 'phone', 'fullname', 'city_id');
        //         },
        //         'reciver.city',

        //     ]
        // )->where('customer_id', $request->customer->id)

        //     ->when($status, function ($query, $status) {
        //         return $query->where('status', $status);
        //     })
        //     ->latest()
        //     ->paginate($this->paginate);

        $orders = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->join('recivers', 'recivers.id', '=', 'orders.reciver_id')
            ->join('cities', 'cities.id', '=', 'recivers.city_id')
            ->select('cities.*', 'orders.id', 'orders.reciver_id', 'orders.customer_id', 'orders.created_at', 'orders.status')
            ->addSelect('recivers.id', 'recivers.fullname', 'recivers.phone')
            ->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price,shippings.order_num')
            ->selectRaw('IF(shippings.charge_on="sender" ,shippings.price - shippings.charge_price ,shippings.price) AS price')
            ->where('orders.customer_id', $request->customer->id)
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($search, function ($query, $search) {
                return $query->where('recivers.fullname', 'LIKE', '%' . $search . '%')
                    ->orWhere('recivers.phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('shippings.order_num', 'LIKE', '%' . $search . '%')
                    ->orWhere('cities.city_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('cities.city_name_en', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->paginate($this->paginate);


        // return $orders;



        return view(
            'order.index.customer',
            [
                'orders' => $orders,
                'view'   => $this->view,
                'status' => $status ?? 'all',
                'search' => $search
            ]
        );
    }
    public function setView($value = null)
    {
        if ($value == null && session('view')) {
            $this->view = session('view');
        } else {
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
