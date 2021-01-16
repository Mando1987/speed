<?php
namespace App\Http\Repositories\Orders;

use App\Models\Order;
use App\Models\Delegate;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use App\Http\Traits\ViewSettingTrait;
use App\Http\Traits\FormatedResponseData;
use App\Http\Interfaces\OrderGetAllRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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
        $orders = Delegate::find($request->adminId)->statuses()->with(['order' => function ($query) {
            return $query->select('id', 'status', 'customer_id', 'reciver_id', 'notes', 'info');
        }])->get()->pluck('order');

        $orders->map(function ($order) {
            $client = $order->status == "ready_to_receipt" ? 'customer' : 'reciver';
            $order->client = $order->$client;

            foreach (['city', 'governorate', 'address'] as $relation) {
                $order->client->$relation = $order->$client->$relation;
            }
            unset($order->$client);
        });

        $orders = $this->paginateOrders($orders);

        // return $orders;

        return response(view(
            $this->indexViewPath,
            [
                'orders' => $orders,
                'view' => $this->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        ));
    }

    public function paginateOrders($orders)
    {
       return  (new Paginator($orders,count($orders) ,$this->paginate, 1 , [
            'path'  => request()->url(),
        ]));
    }
}
