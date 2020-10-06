<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;
use App\Http\Traits\GovernorateTrait;
use App\Models\Customer;
use App\Services\customers\CustomerCreateStoreService;
use App\Services\customers\CustomerEditUpdateService;

class CustomerController extends Controller
{
    use GovernorateTrait;

    public function index()
    {
        //
    }

    public function create()
    {
        return app(CustomerCreateStoreService::class)->create();
    }

    public function store(CustomerStoreFormRequest $request)
    {
        return app(CustomerCreateStoreService::class)->store($request);
    }

    public function show($id)
    {
    }

    public function edit(Customer $customer)
    {
        return app(CustomerEditUpdateService::class)->edit($customer);
    }

    public function update(CustomerUpdateFormRequest $request, Customer $customer)
    {
        return app(CustomerEditUpdateService::class)->update($request, $customer);
    }

    public function destroy($id)
    {
    }
}
