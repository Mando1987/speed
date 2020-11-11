<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Requests\OrderEditFormRequest;

interface OrderRepositoryInterface
{
    public function getAll(Request $request);
    public function showById(Request $request, $id);
    public function create(Request $request);
    public function editOrder(Request $request);
    public function store(OrderStoreFormRequestInterface $request);
    public function update(OrderEditFormRequest $orderEditFormRequest , $id);
    public function print(Request $request);
}
