<?php
namespace App\DryClasses;

use App\Models\City;
use App\Models\Governorate;

class GovernorateClass
{
    protected $governorate;
    protected $city;
    protected $governorates;

    public function __construct(Governorate $governorate, City $city)
    {
        $this->governorates = $governorate::all();
        $this->city = $city;
    }

    public function getAllGovernorates()
    {
        return $this->governorates;
    }
    public function getGovernorateWithCities($governorate_id = null)
    {
        $governorate_id = ($governorate_id !== null && is_int($governorate_id)) ? $governorate_id : $this->governorates->first()->id;
        return $this->city->whereGovernorateId($governorate_id)->get();
    }
}
