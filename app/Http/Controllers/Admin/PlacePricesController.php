<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlacePrice;
use App\Http\Controllers\Controller;
use App\Services\PlacePriceEditService;
use App\Http\Requests\PlacePriceEditFormRequest;
use App\Http\Requests\PlacePriceStoreFormRequest;
use App\Models\City;
use App\Services\Places\PlacePriceFetshDataService;
use App\Services\Places\PlacePriceCreateStoreService;
use App\Services\Places\PlacePriceEditUpdateService;

class PlacePricesController extends Controller
{

    public function index()
    {

        return app(PlacePriceFetshDataService::class)->getGovernorateCitiesPrice(request('governorate_id'));
    }

    public function create()
    {
        return app(PlacePriceCreateStoreService::class)->create(request('showInModel'));
    }

    public function store(PlacePriceStoreFormRequest $request)
    {
        return app(PlacePriceCreateStoreService::class)->store($request);
    }


    public function edit($id)
    {
        return app(PlacePriceEditUpdateService::class)->edit($id);

    }

    public function update(PlacePriceEditFormRequest $request ,$cityId)
    {
        return app(PlacePriceEditUpdateService::class)->update($request, $cityId);

    }

    public function destroy($id)
    {
        PlacePrice::destroy($id);
        notify('success', 'deleted');
        return  redirect()->route('price.index');
    }
}
