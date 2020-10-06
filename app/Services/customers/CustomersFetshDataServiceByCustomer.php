<?php

namespace App\Services\Orders;

use App\Models\Admin;
use App\Models\Order;

class OrdersFetshDataServiceByCustomer extends OrdersFetshDataService
{
    private $searchColumns = ['recivers.phone', 'shippings.order_num', 'cities.city_name', 'cities.city_name_en'];

    public function index($request)
    {
        $customer = Admin::find($request->adminId)->customer;
        $orders = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->join('recivers', 'recivers.id', '=', 'orders.reciver_id')
            ->join('cities', 'cities.id', '=', 'recivers.city_id')
            ->select('cities.*', 'orders.id', 'orders.reciver_id', 'orders.customer_id', 'orders.created_at', 'orders.status')
            ->addSelect('recivers.id', 'recivers.fullname', 'recivers.phone')
            ->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price,shippings.order_num,shippings.customer_price')
            ->where(function ($query) use ($request, $customer) {
                return $query->where('orders.customer_id', $customer->id)
                    ->when($request->search, function ($qsearch) use ($request) {
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


            // return $orders;


        return view(
            'order.index.customer',
            [
                'orders' => $orders,
                'view' => $request->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        );
    }

}
