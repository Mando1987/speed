<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\OrderGetAllRepositoryInterface;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\ViewSettingTrait;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderByDelegateRepository implements OrderGetAllRepositoryInterface
{
    use OrderTrait, FormatedResponseData, ViewSettingTrait;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function getAll(Request $request)
    {
        $this->setViewSetting();
        $orders = $this->order->WithDefaultRealtions()
            ->WithCustomerRelationship()
            ->latest()
            ->paginate($this->paginate);
        return response(view(
            'order.index.manager',
            [
                'orders' => $orders,
                'view' => $this->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        ));
        return 'view by delegate';
    }

}
