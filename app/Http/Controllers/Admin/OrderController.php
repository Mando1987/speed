<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreFormRequest;
use App\Services\currentAdminService;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrdersFetshDataService;
use App\Services\Orders\OrdersStoreService;

class OrderController extends Controller
{

    public function index()
    {
        return app(OrdersFetshDataService::class)->getAllOrders();
    }

    public function create()
    {
        return app(currentAdminService::class)->order()->create();
    }

    public function store(OrderStoreFormRequest $request)
    {
        return app(currentAdminService::class)->order()->store($request);
    }

    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }
}
