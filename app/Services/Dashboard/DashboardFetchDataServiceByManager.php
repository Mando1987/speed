<?php

namespace App\Services\Dashboard;

use App\Models\Order;
use App\Services\Dashboard\DashboardFetchDataService;
use Illuminate\Http\Request;

class DashboardFetchDataServiceByManager extends DashboardFetchDataService
{
    public function index(Request $request)
    {
        $query = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->select('orders.id', 'orders.customer_id', 'orders.status')
            ->selectRaw('(SELECT count(*) FROM orders) as "all_count"');

        $data = $this->orderFilters($query);

        $data = $data->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price')
            ->selectRaw('SUM(shippings.charge_price) AS my_balance_count')
            ->where('orders.status', 'delivered')
            ->first();
        return view('dashboard.manager', ['data' => $data]);
    }
}
