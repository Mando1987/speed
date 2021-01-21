<?php
namespace App\Http\Repositories\Orders\Statuses;

use App\Http\Interfaces\OrderStatusRepositoryInterface;
use App\Models\Order;

class ReceiptFromCustomer implements OrderStatusRepositoryInterface
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
            case 'ready_to_chip':
                return view($this->viewName, ['orderId' => $this->order->id]);
                break;
            case 'pickup_in_storage':
                return view($this->viewName, ['orderId' => $this->order->id]);
                break;
        }
    }
}
