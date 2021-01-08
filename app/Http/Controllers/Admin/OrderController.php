<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\Factories\CreateOrderFactory;
use App\Http\Repositories\Factories\OrderFactory;
use App\Http\Repositories\Factories\OrderStatusFactory;
use App\Http\Repositories\Orders\OrderViewShowStore;
use App\Http\Repositories\Orders\ValidateCustomer;
use App\Http\Repositories\Orders\ValidateReciver;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Requests\ValidateOrderCustomerFormRequest;
use App\Http\Requests\ValidateOrderReciverFormRequest;
use App\Models\Order;
use App\Services\Orders\OrderCountChargePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Request as GlobalRequest;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return OrderFactory::getInstance()->getAll($request);
    }

    public function show(Request $request, $id)
    {
        return OrderFactory::getInstance()->showById($request, $id);
    }

    public function create(Request $request)
    {
        return CreateOrderFactory::getInstance()->create($request);
    }
    public function store(OrderStoreFormRequest $request)
    {
        return CreateOrderFactory::getInstance()->store($request);
    }

    public function validateCustomer(ValidateOrderCustomerFormRequest $request)
    {
        return ValidateCustomer::handle($request);
    }
    public function validateReciver(ValidateOrderReciverFormRequest $request)
    {
        return ValidateReciver::handle($request);
    }
    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }

    public function printInvoice(Request $request)
    {
        return OrderFactory::getInstance()->printInvoice($request);
    }

    public function viewEditPanel(Request $request)
    {
        return view('order.'.$request->adminType.'_view_edit_panel', ['request' => $request]);
    }
    public function editOrder(Request $request)
    {
        return $this->OrderRepositoryInterface->editOrder($request);
    }
    public function update(OrderEditFormRequest $orderEditFormRequest, $id)
    {
        return $this->OrderRepositoryInterface->update($orderEditFormRequest, $id);
    }

    public function viewDeleteDaialog($id)
    {
        return view('includes.delete');
    }

    public function showViewSetting(Request $request)
    {
        return OrderViewShowStore::show($request);
    }

    public function storeViewSetting(Request $request)
    {
        return OrderViewShowStore::store($request);
    }

    public function viewUpdateOrder()
    {
       return OrderStatusFactory::getInstance()->viewActions();
    }

}
