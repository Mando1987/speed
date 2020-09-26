<?php

namespace App\Services\Orders;

use Illuminate\Support\Str;
use App\Services\BaseService;

class OrdersFetshDataService extends BaseService
{
    private $admin;
    private $type;
    private $identifyOrdersFetch;

    public function __construct()
    {
        $identify      = auth('admin')->user();
        $this->type    = $identify->type;
        $type          = $this->type;
        $className     =  __NAMESPACE__ .'\\' . Str::ucfirst($type . 'OrderFetshDataService');
        $this->admin   = $identify->$type;
        $this->identifyOrdersFetch = (new $className);
    }

    public function handle($request)
    {
        return $this->identifyOrdersFetch->handle(
            (object) array_merge($request->all() ,[$this->type => $this->admin])
        );
    }

    // public function editCityPriceRow($id)
    // {
    //     $city = $this->city::where('id', $id)->first();
    //     return view('place-prices.edit', [
    //         'city_price' => $city->placePrices,
    //         'city_name' => $city->name,
    //         'governorate_name' => $city->governorate->name,
    //     ]);
    // }
}
