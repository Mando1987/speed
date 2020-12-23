<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\Factories\MainFactory;
use App\Http\Repositories\Orders\ValidateCustomer;
use App\Http\Repositories\Orders\ValidateReciver;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Requests\ValidateOrderCustomerFormRequest;
use App\Http\Requests\ValidateOrderReciverFormRequest;
use App\Http\Traits\FormatedResponseData;
use App\Services\Orders\OrderCountChargePrice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderFactory;

    public function __construct(MainFactory $orderFactory)
    {
        $this->orderFactory = $orderFactory->getInstance(OrderRepositoryInterface::class);
    }
    public function index(Request $request)
    {
        return $this->orderFactory->getAll($request);
    }

    public function show(Request $request, $id)
    {
        return $this->OrderRepositoryInterface->showById($request, $id);
    }

    public function create(Request $request)
    {
        return $this->orderFactory->getInstance(CreateOrderRepositoryInterface::class)->create($request);
    }

    public function validateCustomer(ValidateOrderCustomerFormRequest $request)
    {
        return ValidateCustomer::handle($request);
    }
    public function validateReciver(ValidateOrderReciverFormRequest $request)
    {
        return ValidateReciver::handle($request);
    }

    public function store(OrderStoreFormRequest $request)
    {
        return $this->orderFactory->getInstance(CreateOrderRepositoryInterface::class)->store($request);
    }

    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }

    function print(Request $request) {
        // return $this->OrderRepositoryInterface->print($request);
    }

    public function viewEditPanel(Request $request)
    {
        return view('order.view_edit_panel', ['request' => $request]);
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

}
