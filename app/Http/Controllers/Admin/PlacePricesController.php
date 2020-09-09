<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlacePriceEditFormRequest;
use App\Http\Requests\PlacePriceStoreFormRequest;
use App\Models\PlacePrice;
use App\Services\PlacePriceEditService;
use App\Services\PlacePriceFetshDataService;
use App\Services\PlacePriceStoreService;

class PlacePricesController extends Controller
{

    public function index()
    {

        return app(PlacePriceFetshDataService::class)->getGovernorateCitiesPrice(request('governorate_id'));
    }

    public function create()
    {
        return app(PlacePriceFetshDataService::class)->createNewCityPrice();

    }

    public function store(PlacePriceStoreFormRequest $request)
    {
        return app(PlacePriceStoreService::class)->handle($request->validated());
    }


    public function edit($id)
    {

        return app(PlacePriceFetshDataService::class)->editCityPriceRow($id);

    }

    public function update(PlacePriceEditFormRequest $request ,$cityId)
    {
        return app(PlacePriceEditService::class)->handle($request->validated() , $cityId);

    }

    public function destroy($id)
    {
        PlacePrice::destroy($id);
        notify('success', 'deleted');
        return  redirect()->route('price.index');
    }
}
