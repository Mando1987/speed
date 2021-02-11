<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;

interface OrderRepositoryInterface extends OrderGetAllRepositoryInterface
{
    public function showById(Request $request, $id);
    public function editOrder(Request $request);
    public function update(OrderEditFormRequest $orderEditFormRequest, $id);
    public function printInvoice(Request $request);
      /**
     * show create page
     *
     * @param \Illuminate\Http\Request $request
     *
    */
    public function create(Request $request);
    /**
     * store order in database
     * @param \App\Http\Requests\OrderStoreFormRequest $request
     */
    public function store(OrderStoreFormRequest $request);
}
