<?php
namespace App\Http\Interfaces;

use App\Http\Requests\OrderEditFormRequest;
use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function getAll(Request $request);
    public function showById(Request $request, $id);
    public function editOrder(Request $request);
    public function update(OrderEditFormRequest $orderEditFormRequest, $id);
    public function printInvoice(Request $request);
}
