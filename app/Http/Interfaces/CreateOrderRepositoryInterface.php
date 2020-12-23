<?php
namespace App\Http\Interfaces;

use App\Http\Requests\OrderStoreFormRequest;
use Illuminate\Http\Request;

interface CreateOrderRepositoryInterface
{
    public function create(Request $request);
    public function store(OrderStoreFormRequest $request);
}
