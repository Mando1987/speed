<?php

namespace App\Services\Delegates;

use App\Models\City;
use App\Models\Governorate;
use App\Services\BaseService;


class DelegateFetshDataService extends BaseService
{
    const IMAGE_PATH = 'orders/';


    public function getAllOrders()
    {
        $orders = $this->order::with('shipping' , 'sender:id,fullname,city_id' , 'sender.city')->paginate(12);

        //  return $orders;

        return view('order.index' , [
           'orders' => $orders
        ]);
    }

    public function create()
    {
        return $this->viewCreateWithGovernorates('delegate.create');
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
