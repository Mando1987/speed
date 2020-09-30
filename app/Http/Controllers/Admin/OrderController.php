<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreFormRequest;
use App\Services\CurrentAdminService;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrdersCreateStoreDataService;
use App\Services\Orders\OrdersFetshDataService;
use App\Services\Orders\OrdersStoreService;

class OrderController extends Controller
{

    public function index()
    {
        return app(OrdersFetshDataService::class)->index(request());
    }

    public function show($id)
    {
        return app(OrdersFetshDataService::class)->show($id);
    }

    public function create()
    {
        return app(OrdersCreateStoreDataService::class)->create();
    }

    public function store(OrderStoreFormRequest $request)
    {
        // dd($request->validated());
        return app(OrdersCreateStoreDataService::class)->store($request);
    }


    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }

    public function print()
    {
       return view('order.print');
    }

}
