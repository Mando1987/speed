<?php

namespace App\Services\Dashboard;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Services\CurrentAdminService;
use Illuminate\Database\Eloquent\Builder;

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

        $query = Shipping::query()
            ->select('order_id')
            ->selectRaw('SUM(price)-(SELECT SUM(charge_price) FROM shippings WHERE charge_on="sender") AS my_balance_count')
            ->selectRaw("(SELECT COUNT(*) FROM orders WHERE customer_id ={$this->id}) AS all_count");

        foreach ($filters as $index) {
            $data = $query->selectRaw(Str::replaceArray('?', [$index, $this->id, $index], $queryText));
        }

        $data = $query->whereIn('order_id', Order::select('id')->where(function ($q) {
            $q->where('customer_id', $this->id)
                ->where('status', 'delivered');
        })->get())
            ->first();

        return view('dashboard.customer', ['data' => $data]);
    }
}
