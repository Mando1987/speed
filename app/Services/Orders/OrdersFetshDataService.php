<?php

namespace App\Services\Orders;

use Illuminate\Support\Str;
use App\Services\BaseService;

class OrdersFetshDataService extends BaseService
{
    private $admin;
    private $type;
    private $service;
    private $className;

    public function __construct()
    {
        $this->admin     = auth('admin')->user();
        $this->type      = $this->admin->type;
        $this->className =  __NAMESPACE__ .'\\' . Str::ucfirst($this->type . 'OrderFetshDataService');
        $this->service   = (new $this->className);
    }

    public function handle()
    {
        return $this->service->handle($this->admin);
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
