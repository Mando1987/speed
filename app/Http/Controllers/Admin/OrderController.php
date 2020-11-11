<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Orders\OrderCountChargePrice;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Requests\OrderEditFormRequest;

class OrderController extends Controller
{
    protected $OrderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $OrderRepositoryInterface)
    {
        $this->OrderRepositoryInterface = $OrderRepositoryInterface;
    }
    public function index(Request $request)
    {
        return $this->OrderRepositoryInterface->getAll($request);
    }

    public function show(Request $request, $id)
    {
        return $this->OrderRepositoryInterface->showById($request,$id);
    }

    public function create(Request $request)
    {
        return $this->OrderRepositoryInterface->create($request);
    }

    public function store(OrderStoreFormRequestInterface $request)
    {
        return $this->OrderRepositoryInterface->store($request);

    }

    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }

    function print(Request $request) {
        return $this->OrderRepositoryInterface->print($request);
    }

    public function viewEditPanel(Request $request)
    {
       return view('order.view_edit_panel', ['request' => $request]);
    }
    public function editOrder(Request $request)
    {
        return $this->OrderRepositoryInterface->editOrder($request);
    }
    public function update(OrderEditFormRequest $orderEditFormRequest , $id)
    {
        return $this->OrderRepositoryInterface->update($orderEditFormRequest, $id);

    }

    public function viewDeleteDaialog($id)
    {
       return view('includes.delete');
    }

}
