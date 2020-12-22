<?php
namespace App\Http\Interfaces;

use Illuminate\Http\Request;
use App\Http\Traits\CallStaticClass;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;

abstract class OrderRepositoryAbstract
{
    use CallStaticClass;

    // abstract public function getAll(Request $request);
    // abstract public function showById(Request $request, $id);
    abstract static public function create();
    // abstract public function store(OrderStoreFormRequest $request);
    // abstract public function editOrder(Request $request);
    // abstract public function update(OrderEditFormRequest $orderEditFormRequest, $id);
}
