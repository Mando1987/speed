<?php

namespace App\Http\Traits;
use App\Models\Governorate;


trait GovernorateTrait
{
    public function getAllGovernoratesAndCities()
    {
        $governorates = Governorate::all();
        $firstGovernoratesCities = $governorates->first()->cities;
        return  ['governorates' => $governorates , 'cities' => $firstGovernoratesCities];
    }

    public function getCities()
    {
        return $governorateCities = Governorate::findOrFail(request('governorate_id'))->cities()->get();
        return response()->json($governorateCities);
    }
}