<?php
namespace App\Http\Repositories\Orders\Statuses;

use App\Http\Interfaces\OrderStatusRepositoryInterface;
use App\Models\Delegate;
use App\Models\Order;
use Log;

class PossibilityOfDelivery implements OrderStatusRepositoryInterface
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
        Log::info($this->order->status);

        switch ($this->order->status) {
            case 'under_review':
                return view($this->viewName, ['orderId' => $this->order->id]);
                break;
            case 'under_preparation':
                return view($this->viewName, ['orderId' => $this->order->id, 'delegates' => Delegate::get()]);
                break;
        }
    }
}
