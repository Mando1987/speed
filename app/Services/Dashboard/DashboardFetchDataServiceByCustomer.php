<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Dashboard\DashboardFetchDataService;


class DashboardFetchDataServiceByCustomer extends DashboardFetchDataService
{

    public function index(Request $request)
    {
        $customer = Admin::find($request->adminId)->customer;

        $query = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->select('orders.id', 'orders.customer_id', 'orders.status')
            ->selectRaw('(SELECT count(*) FROM orders where customer_id = ' . $customer->id . ') as "all_count"');

        $data = $this->orderFilters($query);

        $data = $data->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price')
            ->selectRaw('SUM(shippings.customer_price) AS my_balance_count')
            ->where('orders.customer_id', $customer->id)
            ->where('orders.status', 'delivered')
            ->first();

        return view('dashboard.customer', ['data' => $data]);
    }
}
