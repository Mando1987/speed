<?php
namespace App\Http\Interfaces;

use App\Http\Requests\OrderStoreFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

interface CreateOrderRepositoryInterface
{
    /**
     * show create page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
    */
    public function create(Request $request) : View;
    /**
     * store order in database
     * @param \App\Http\Requests\OrderStoreFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStoreFormRequest $request) :JsonResponse;
}
