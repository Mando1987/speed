<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\BaseService;

class OrdersFetshDataServiceByManager extends BaseService
{
    private $searchColumns = ['recivers.phone', 'shippings.order_num', 'cities.city_name', 'cities.city_name_en'];

    public function index($request)
    {
        $orders = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->join('recivers', 'recivers.id', '=', 'orders.reciver_id')
            ->join('cities', 'cities.id', '=', 'recivers.city_id')
            ->select('cities.*', 'orders.id', 'orders.reciver_id', 'orders.customer_id', 'orders.created_at', 'orders.status')
            ->addSelect('recivers.id', 'recivers.fullname', 'recivers.phone')
            ->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price,shippings.order_num,shippings.customer_price')
            ->where(function ($query) use ($request) {
                return  $query->when($request->search, function ($qsearch) use ($request) {
                    $columns = $qsearch->where('recivers.fullname', 'LIKE', '%' . $request->search . '%');

                    foreach ($this->searchColumns as $key) {
                        $columns = $columns->orWhere($key, 'LIKE', "%{$request->search}%");
                    }
                    return $columns;
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
    public function show(array $data)
    {
        $order = Order::with(['shipping', 'reciver', 'reciver.city'])
            ->where('id', $data['id'])
            ->first();

        return view(
            'order.show',
            [
                'order' => $order,
            ]
        );
    }
}
