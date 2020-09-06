<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerStoreFormRequest;
use App\Models\City;
use App\Models\Customer;
use App\Models\Governorate;
use App\Services\CustomerStoreService;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $governorates = Governorate::all();
        $firstGovernoratesCities = $governorates->first()->cities;
        return view('customer.create' , ['governorates' => $governorates , 'cities' => $firstGovernoratesCities]);
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

    public function getCities()
    {
        return $governorateCities = Governorate::findOrFail(request('governorate_id'))->cities()->get();
        return response()->json($governorateCities);
    }
}
