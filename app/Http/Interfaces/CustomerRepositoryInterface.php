<?php
namespace App\Http\Interfaces;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Requests\CustomerUpdateFormRequest;

interface CustomerRepositoryInterface
{
    public function create();
    public function store(CustomerStoreFormRequest $request);
    public function updateByOrder(CustomerFormRequest $request, $id);
    public function edit(Customer $customer);
    public function update(CustomerUpdateFormRequest $request,Customer $customer);

}
