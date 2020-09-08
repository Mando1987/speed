<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Http\Traits\GovernorateTrait;
use App\Models\City;
use App\Models\Customer;
use App\Models\Governorate;
use App\Services\CustomerStoreService;

class CustomerController extends Controller
{
    use GovernorateTrait;

    public function index()
    {
        //
    }

    public function create()
    {

        return view('customer.create' , $this->getAllGovernoratesAndCities() );
    }

    public function store(CustomerStoreFormRequest $request)
    {
        return app(CustomerStoreService::class)->handle($request->validated());
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
