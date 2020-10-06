<?php

namespace App\Services\Orders;

use App\Models\Order;

class OrdersFetshDataServiceByManager extends OrdersFetshDataService
{
    private $searchColumns = [
        'recivers.fullname',
        'recivers.phone',
        'shippings.order_num',
        'cities.city_name',
        'cities.city_name_en',
        'customers.fullname',
        'customers.phone',
    ];

    public function index($request)
    {
        $orders = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('recivers', 'recivers.id', '=', 'orders.reciver_id')
            ->join('cities', 'cities.id', '=', 'customers.city_id')
            ->select('cities.*', 'orders.id', 'orders.reciver_id', 'orders.customer_id', 'orders.created_at', 'orders.status')
            ->addSelect('customers.id as customer_id', 'customers.fullname as customer_fullname', 'customers.phone as customer_phone', 'customers.city_id')
            ->addSelect('recivers.id as reciver_id', 'recivers.fullname as reciver_fullname')
            ->selectRaw('shippings.id,shippings.order_id,shippings.order_num,shippings.total_price')

            ->where(function ($query) use ($request) {
                return $query->when($request->search, function ($qsearch) use ($request) {
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

            foreach ($orders as $index => &$order) {
                $order->city = app()->getLocale() == 'ar' ? $order->city_name:$order->city_name_en;
                $order->date = $order->created_at->format('Y-m-d');
                $order->getStatus = trans('site.order_status_' . $order->status);
            }
        return view(
            'order.index.manager',
            [
                'orders' => $orders,
                'view' => $request->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        );
    }
    public function show($request, $id)
    {
        $order = Order::with(['shipping', 'reciver','reciver.city' , 'customer' ,'customer.city'])
            ->where('id', $id)
            ->first();

        return view(
            'order.show.' .$request->adminType,
            [
                'order' => $order,
            ]
        );
    }
}
