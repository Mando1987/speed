<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\OrderStatusRepositoryInterface;
use App\Http\Repositories\Orders\Statuses\PossibilityOfDelivery;
use App\Http\Repositories\Orders\Statuses\ReceiptFromTheCustomer;
use App\Models\Order;

class OrderStatusFactory implements BaseFactoryInterface
{
    public static function getInstance(): OrderStatusRepositoryInterface
    {
        /**
         * TODO : any thing for test
         */
        $order = Order::with(['statuses' => function ($query) {
            $query->orderByDesc('created_at')->first();
        }])->find(request()->order_id);

        switch ($order->statuses->first()->step) {
            case 'STEP1':
                return new PossibilityOfDelivery($order);
                break;
            case 'STEP2':
                return new ReceiptFromTheCustomer($order);
                break;
            // case 'STEP3':
            //     return new ReceiptFromTheCustomer($order);
            //     break;
            // default:
            //     abort(404);
            //     break;
        }
    }
}
