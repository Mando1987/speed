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
     *  [1] possibility_of_delivery امكانيه التسليم
     *    -> under_review
     *    -> under_preparation
     *  [2] Receipt_from_the_customer الاستلام من العميل
     *        -> ready_to_receipt
     *        -> pickup_in_storage
     *        -> ready_to_chip
     *  [3] storage التخزين
     *  [4] Delivery_to_the_customer التسليم الى العميل
     *  [5] Treasury الخزنة
     *  [6] cash النقدية
     *  [6] customer_termination الانتهاء
     *  Pick up
     *
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
        }
    }
}
