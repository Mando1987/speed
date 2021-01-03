<?php
namespace App\Http\Services;

use App\Models\Governorate;
use Illuminate\Support\Facades\Cache;

class GovernorateService
{
    private $governorates;

    public function __construct(Governorate $governorate)
    {
        $cachedGovernates = Cache::get('governorates');
        if ($cachedGovernates) {
            $this->governorates = $cachedGovernates;
        } else {
            $this->governorates = $governorate->get();
        }

        Cache::put('governorates', $this->governorates);
    }

    public function getAllGovernorates()
    {
        return $this->governorates;
    }
    public function allCitiesForFirstGovernorate()
    {
        return $this->governorates->first()->cities;
    }
    public function allCitiesForGovernorate(int $governorateId)
    {
        return $this->governorates->firstWhere('id',$governorateId)->cities;
    }
}
