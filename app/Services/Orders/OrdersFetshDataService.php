<?php

namespace App\Services\Orders;

use App\Models\City;
use App\Models\Governorate;
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
        $page = (request('page')) ? request('page') : 1;

        if ($page == 2 && !session('sender')) {
            $page = 1;
        } elseif ($page == 3 && !session('sender') && !session('reciver')) {

            $page = 1;
        } elseif ($page == 3 && session('sender') && !session('reciver')) {

            $page = 2;
        }
        session(['page' => $page]);
        $data['sender']  = session('sender') ? session('sender') : $this->getSenderOrReciverArray();
        $data['reciver'] = session('reciver') ? session('reciver') : $this->getSenderOrReciverArray();
        $data['page']    = $page;
        // return session('sender');
        return view('order.create', array_merge($this->getAllGovernoratesAndCities(), $data));
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

    public function getSenderOrReciverArray()
    {
        return [
            'fullname'       => '',
            'phone'          => '',
            'governorate_id' => 1,
            'address'        => '',
            'special_marque' => '',
            'house_number'   => '',
            'door_number'    => '',
            'shaka_number'   => '',
            'city_id'        => 1,
            'other_phone'    => '',
        ];
    }
}
