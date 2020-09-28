<?php

namespace App\Services\Dashboard;

use App\Models\Order;
use Illuminate\Support\Str;

class DashboardFetchDataServiceByManager
{
    public function index($manager)
    {
        return $manager;
        $filters = [
            'under_review',
            'under_preparation',
            'ready_to_chip',
            'delivered',
            'postpond',
            'cancelld',
        ];
        $queryText = "(SELECT COUNT(*) FROM orders WHERE status='?') AS '?_count'";

        $query = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->select('orders.id', 'orders.customer_id', 'orders.status')
            ->selectRaw('(SELECT count(*) FROM orders) as "all_count"');
        foreach ($filters as $index) {
            $data = $query->selectRaw(Str::replaceArray('?', [$index, $index], $queryText));
        }

        $data = $data->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price')
            ->selectRaw('SUM(shippings.charge_price) AS my_balance_count')
            ->where('orders.status', 'delivered')
            ->first();
        return view('dashboard.manager', ['data' => $data]);
    }
}
