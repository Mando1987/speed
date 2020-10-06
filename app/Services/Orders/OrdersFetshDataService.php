<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Services\BaseService;

class OrdersFetshDataService extends BaseService
{
    protected $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    protected $paginate = 6;
    protected $view = 'list';

    public function index($request)
    {
        $this->setView($request->view ?? null);
        return $this->identify($request)->index(
            (object) array_merge(
                $request->all(),
                [
                    'status' => ($request->status ?? false) && in_array($request->status, $this->orderStatuses) ? $request->status : false,
                    'search' => $request->search ?? false,
                    'view' => $this->view,
                    'paginate' => $this->paginate,
                ]
            )
        );
    }
    public function show($request, $id)
    {
        $relationsLoded = ['reciver', 'reciver.city', 'reciver.address', 'shipping'];
        if ($request->adminType == 'manager') {
            $relationsLoded = array_merge($relationsLoded, ['customer', 'customer.city', 'customer.address']);
        }
        $orderData = Order::with($relationsLoded)->where('id', $id)->first();


        $orderData->shipping->final_price = ($request->adminType == 'manager') ?
            $orderData->shipping->total_price :
            $orderData->shipping->customer_price;

        return view(
            'order.show.' . $request->adminType,
            [
                'order' => $orderData,
            ]
        );
    }
    private function setView($value = null)
    {
        if ($value == null && session('view')) {
            $this->view = session('view');
        } else {
            if ($value == 'grid' || $value == 'list') {
                $this->view = $value;
                session(['view' => $this->view]);
            }
        }
        $this->setPaginate();
        return $this;
    }
    private function setPaginate()
    {
        $this->paginate = 6;
        if ($this->view == 'list') {
            $this->paginate = 12;
        }
    }

    public function print($request)
    {
        if ($request->adminType == 'manager')
            $order = Order::select('id', 'customer_id', 'reciver_id', 'user_can_open_order')->with([
                'customer:id,fullname,phone',
                'customer.address:addressable_id,address',
                'reciver:id,fullname,phone',
                'reciver.address',
                'shipping:order_id,total_price,charge_on'
            ])->where('id', $request->orderId)->first();
        // return $order;
        return view('order.print');
        return abort(404);
    }
}
