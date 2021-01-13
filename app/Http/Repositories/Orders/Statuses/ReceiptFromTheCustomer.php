<?php
namespace App\Http\Repositories\Orders\Statuses;

use App\Http\Interfaces\OrderStatusRepositoryInterface;
use App\Models\Delegate;
use App\Models\Order;
use Log;

class ReceiptFromTheCustomer implements OrderStatusRepositoryInterface
{
    private $order;
    private $viewName;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->viewName = sprintf('order.statuses.%s', $this->order->status);
    }
    public function viewActions()
    {
        switch ($this->order->status) {
            case 'ready_to_receipt':
                return view($this->viewName, ['orderId' => $this->order->id]);
                break;
        }
    }
}