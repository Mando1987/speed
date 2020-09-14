<?php

namespace App\Services\Orders;

use App\Models\City;
use App\Models\Governorate;
use App\Models\OrderStore;
use App\Services\BaseService;


class OrdersFetshDataService extends BaseService
{
    //const IMAGE_PATH = 'customers/';
    public function getGovernorateCitiesPrice($governorate_id)
    {
        $gov_id = $governorate_id ? $governorate_id : 1;

        $governorateCitiesPrice = $this->city::where('governorate_id', $gov_id)->with('placePrices')->paginate(12);
        return view('place-prices.index', [
            'governorateCitiesPrice' => $governorateCitiesPrice,
            'governorates'           => $this->getAllGovernorates(),
            'selectedGovId'          => $gov_id
        ]);
    }

    public function createNewOrder()
    {
        $userData = app(OrderSaveUserDataToSession::class)->handle(request('page'));

        // dd($userData);

        return view('order.create', array_merge($this->getAllGovernoratesAndCities(), ['userData' => $userData]));
    }

    public function editCityPriceRow($id)
    {
        $city = $this->city::where('id', $id)->first();
        return view('place-prices.edit', [
            'city_price'       => $city->placePrices,
            'city_name'        => $city->name,
            'governorate_name' => $city->governorate->name,
        ]);
    }

}
