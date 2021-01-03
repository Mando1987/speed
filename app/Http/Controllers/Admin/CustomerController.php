<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Repositories\Factories\CustomerFetshDataFactory;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;
use App\Http\Traits\GovernorateTrait;
use App\Models\Customer;
use App\Services\customers\CustomerEditUpdateService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function index(Request $request)
    {
        return CustomerFetshDataFactory::getInstance()->getAll($request);
    }
    public function create()
    {
        return $this->customerRepository->create();
    }
    public function store(CustomerStoreFormRequest $request)
    {
        return $this->customerRepository->store($request);
    }
    public function show($id)
    {
    }
    public function edit(Customer $customer)
    {
        return $this->customerRepository->edit($customer);
    }
    public function update(CustomerUpdateFormRequest $request, Customer $customer)
    {
        return $this->customerRepository->update($request, $customer);
    }
    public function updateByOrder(CustomerFormRequest $customerFormRequest, $id)
    {
        return $this->customerRepository->updateByOrder($customerFormRequest, $id);
    }

    public function destroy($id)
    {
    }
}
