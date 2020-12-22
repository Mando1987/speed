<?php
namespace App\Http\Interfaces;

use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function getAll(Request $request);
    public function showById(Request $request, $id);
    public function create(Request $request);
    public function store(OrderStoreFormRequest $request);
    public function editOrder(Request $request);
    public function update(OrderEditFormRequest $orderEditFormRequest, $id);
}
