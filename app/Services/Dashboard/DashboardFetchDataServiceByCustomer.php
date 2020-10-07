<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class DashboardFetchDataServiceByCustomer
{
    public function index(Request $request)
    {
        $customer = Admin::find($request->adminId)->customer;
        $filters = [
            'under_review',
            'under_preparation',
            'ready_to_chip',
            'delivered',
            'postpond',
            'cancelld',
        ];
        $queryText = "(SELECT COUNT(*) FROM orders WHERE status='?' and customer_id ='?') AS '?_count'";

        $query = Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->select('orders.id', 'orders.customer_id', 'orders.status')
            ->selectRaw('(SELECT count(*) FROM orders where customer_id = '.$customer->id.') as "all_count"');
        foreach ($filters as $index) {
            $data = $query->selectRaw(Str::replaceArray('?', [$index, $customer->id, $index], $queryText));
        }

        $data = $data->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price')
            ->selectRaw('SUM(shippings.customer_price) AS my_balance_count')
            ->where('orders.customer_id', $customer->id)
            ->where('orders.status', 'delivered')
            ->first();

        return view('dashboard.customer', ['data' => $data]);
    }
}
