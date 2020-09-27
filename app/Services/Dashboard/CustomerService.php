<?php

namespace App\Services\Dashboard;

use App\Models\Customer;
use App\Models\Order;
use App\Services\CurrentAdminService;
use Illuminate\Support\Str;

class CustomerService
{
    protected $customer;
    protected $current;
    protected $id;
    public function __construct()
    {

        $this->current = app(CurrentAdminService::class);
        $this->customer = $this->current->customer();
        $this->id = $this->current->getId();
    }

    public function index()
    {
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
            ->selectRaw('(SELECT count(*) FROM orders) as "all_count"');
        foreach ($filters as $index) {
            $data = $query->selectRaw(Str::replaceArray('?', [$index, $this->id, $index], $queryText));
        }

        $data = $data->selectRaw('shippings.id,shippings.order_id,shippings.charge_on,shippings.charge_price')
            ->selectRaw('SUM(shippings.customer_price) AS my_balance_count')
            ->where('orders.customer_id', $this->id)
            ->where('orders.status', 'delivered')
            ->first();
        return view('dashboard.customer', ['data' => $data]);
    }
}
