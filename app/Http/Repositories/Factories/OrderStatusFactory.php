<?php
namespace App\Http\Repositories\Factories;

use App\Models\Order;
use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\OrderStatusRepositoryInterface;
use App\Http\Repositories\Orders\Statuses\PossibilityOfDelivery;

class OrderStatusFactory implements BaseFactoryInterface
{
    public static function getInstance(): OrderStatusRepositoryInterface
    {
        $order = Order::with(['statuses' => function ($query) {
            $query->orderByDesc('created_at')->first();
        }])->find(request()->order_id);

        switch ($order->statuses->first()->step) {
            case 'possibility_of_delivery':
                return new PossibilityOfDelivery($order);
                break;
            default:
                abort(404);
                break;
        }
    }
}
