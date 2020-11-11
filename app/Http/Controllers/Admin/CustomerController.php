<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Traits\GovernorateTrait;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;
use App\Services\customers\CustomerEditUpdateService;
use App\Services\Customers\CustomersFetshDataService;
use App\Services\customers\CustomerCreateStoreService;

class CustomerController extends Controller
{
    use GovernorateTrait;

    private $customerRepositoryInterface;

    public function __construct(CustomerRepositoryInterface  $customerRepositoryInterface)
    {
        $this->customerRepositoryInterface = $customerRepositoryInterface;
    }

    public function index(Request $request)
    {
         return app(CustomersFetshDataService::class)->index($request);
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

    public function updateByOrder(CustomerFormRequest $customerFormRequest , $id)
    {
      return $this->customerRepositoryInterface->updateByOrder($customerFormRequest , $id);
    }

    public function destroy($id)
    {
    }
}
