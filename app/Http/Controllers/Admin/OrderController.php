<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreFormRequest;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrdersCreateStoreDataService;
use App\Services\Orders\OrdersFetshDataService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return app(OrdersFetshDataService::class)->index($request);
    }

    public function show(Request $request, $id)
    {
        return app(OrdersFetshDataService::class)->show($request, $id);
    }

    public function create(Request $request)
    {
        return app(OrdersCreateStoreDataService::class)->create($request);
    }

    public function store(OrderStoreFormRequest $request)
    {
        return app(OrdersCreateStoreDataService::class)->store($request);
    }

    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }

    function print(Request $request) {
        return app(OrdersFetshDataService::class)->print($request);
    }

}
