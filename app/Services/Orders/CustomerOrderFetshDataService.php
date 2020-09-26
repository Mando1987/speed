<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\BaseService;

class CustomerOrderFetshDataService extends BaseService
{

    public function handle($request)
    {

        $orders = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->join('recivers', 'recivers.id', '=', 'orders.reciver_id')
            ->join('cities', 'cities.id', '=', 'recivers.city_id')
            ->select('cities.*', 'orders.id', 'orders.reciver_id', 'orders.customer_id', 'orders.created_at', 'orders.status')
            ->addSelect('recivers.id', 'recivers.fullname', 'recivers.phone')
            ->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price,shippings.order_num')
            ->selectRaw('IF(shippings.charge_on="sender" ,shippings.price - shippings.charge_price ,shippings.price) AS price')

            ->where(function ($query) use ($request) {
                return $query->where('orders.customer_id', $request->customer->id)
                    ->when($request->search, function ($qsearch) use ($request) {
                        return $qsearch->where('recivers.fullname', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('recivers.phone', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('shippings.order_num', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('cities.city_name', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('cities.city_name_en', 'LIKE', '%' . $request->search . '%');
                    })
                    ->when($request->status, function ($qstatus) use ($request) {
                        return $qstatus->where('status', $request->status);
                    });
            })
            ->latest()
            ->paginate($request->paginate);

        return view(
            'order.index.customer',
            [
                'orders' => $orders,
                'view'   => $request->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search
            ]
        );
    }

}
