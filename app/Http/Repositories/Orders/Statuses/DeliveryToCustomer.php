<?php
namespace App\Http\Repositories\Orders\Statuses;

use App\Http\Interfaces\OrderStatusRepositoryInterface;
use App\Models\Delegate;
use App\Models\Order;
use Log;

class DeliveryToCustomer implements OrderStatusRepositoryInterface
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
            case 'deliverd':
                return view($this->viewName, ['orderId' => $this->order->id]);
                break;
            case 'cancelled':
                return view($this->viewName, ['orderId' => $this->order->id]);
                break;
        }
    }
}
