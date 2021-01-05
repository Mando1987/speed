<?php
namespace App\Http\Traits\Dashboard;

use App\Models\Order;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

trait IndexTrait
{
    private $orderStatuses = [
        'all' => ['total' => 0],
        'under_review' => ['total' => 0],
        'under_preparation' => ['total' => 0],
        'myBalance' => ['total' => 0],
        'ready_to_chip' => ['total' => 0],
        'delivered' => ['total' => 0],
        'postpond' => ['total' => 0],
        'cancelld' => ['total' => 0],
    ];
    /**
     * * formated data to view data like : ['status' => ['total' => value]]
     * @param Collection $allStatus
     *
     * @return array
     */
    private function formatedData(Collection  $allStatus) :array
    {
        $data = [];
        $totalOrders = $myBalance = 0;
        foreach ($this->orderStatuses as $status => $value) {

            foreach ($allStatus as $index => $orderStatusData) {
                if ($orderStatusData->status == $status) {
                    $myBalance = $orderStatusData->status == 'delivered' ? $orderStatusData->myBalance : 0;
                    $data[$status] = ['total' => $orderStatusData->total];
                    $totalOrders += $orderStatusData->total;
                    unset($allStatus[$index]);
                }
            }
        }
        $data['all'] = ['total' => $totalOrders];
        $data['myBalance'] = ['total' => $myBalance];

        return  array_merge($this->orderStatuses, $data);
    }
    /**
     * builed Query Order
     *
     * @param string $columnToSum
     *
     * @return Builder
     */
    private function builedQueryOrder($columnToSum = 'customer_price') :Builder
    {
       return  Order::join('shippings', 'shippings.order_id', '=', 'orders.id')
            ->selectRaw('orders.id,orders.status,shippings.id,shippings.order_id,shippings.charge_price')
            ->selectRaw('count(orders.id) AS total')
            ->selectRaw(sprintf("IF(orders.status='delivered',SUM(shippings.%s),0) As myBalance", $columnToSum))
            ->groupBy('status')
            ->orderBy('orders.id');
    }
}
