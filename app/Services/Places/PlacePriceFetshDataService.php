<?php

namespace App\Services;

use App\Models\City;
use App\Models\Governorate;


class PlacePriceFetshDataService extends BaseService
{

    //const IMAGE_PATH = 'customers/';

    public $city, $governorate, $route = 'price.index';

    public function __construct(City $city, Governorate $governorate)
    {
        $this->governorate = $governorate;
        $this->city = $city;
    }

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

    public function createNewCityPrice($showInModel = false)
    {

        if ($showInModel == true){
            $reciver = session('reciver');
            $data = ['governorate_id'=> $reciver['governorate_id'], 'city_id' =>  $reciver['city_id']];
            return view('place-prices.create-in-model' , $data);
        }

        return view('place-prices.create', $this->getAllGovernoratesAndCities());
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
    public function getAllGovernorates()
    {
        return $this->governorate::all();
    }
    public function getAllGovernoratesAndCities()
    {

        $firstGovernoratesCities = $this->getAllGovernorates()->first()->cities;
        return  ['governorates' => $this->getAllGovernorates(), 'cities' => $firstGovernoratesCities];
    }

    public function getCities()
    {
        return  $this->governorate::findOrFail(request('governorate_id'))->cities()->get();
    }
}
