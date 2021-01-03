<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use App\Http\Services\GovernorateService;

class Cities extends Component
{
    public $name;
    public $cities;

    public function __construct($name = 'city_id', GovernorateService $governorateService)
    {
        $this->name = Str::contains($name, '[]') ? Str::replaceFirst('[', '[city_id', $name) : $name;
        $this->cities = $governorateService->allCitiesForFirstGovernorate();
    }

    public function render()
    {
        return view('components.cities');
    }
}
