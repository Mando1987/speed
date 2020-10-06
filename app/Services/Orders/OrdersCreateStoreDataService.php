<?php

namespace App\Services\Orders;

use App\Services\BaseService;
use App\Services\Orders\OrderSaveUserDataToSession;

class OrdersCreateStoreDataService extends BaseService
{

    const IMAGE_PATH = 'orders/';

    public $route = 'order.index';


    public function create($request)
    {
        $userData = app(OrderSaveUserDataToSession::class)->handle(request('page'));
        return view('order.create.' . $request->adminType, ['userData' => $userData]);
    }

    public function store($request)
    {
        return $this->identify($request)->store($request);
    }

    protected function orderPath($request, $page)
    {
        $data = $request->validated();

        if (isset($data['customer'])) {
            session(['customer' => $data['customer']]);
            session(['customerAddress' => $data['address']]);
        }
        if (isset($data['reciver'])) {
            session(['reciver' => $data['reciver']]);
            session(['reciverAddress' => $data['address']]);

        }
        session(['page' =>  $page]);
        return redirect()->route('order.create', ['page' => $page]);
    }

    protected function setOrderNumberUnique($orderId)
    {
        return   3018 . ($orderId + 4);
    }
}
