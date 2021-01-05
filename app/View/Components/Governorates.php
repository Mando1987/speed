<?php

namespace App\View\Components;

use App\Http\Services\GovernorateService;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Governorates extends Component
{
    public $name;
    public $governorates;
    public $cityName;
    public function __construct($name = 'governorate_id', GovernorateService $governorateService)
    {
        $this->name = Str::contains($name, '[]') ? Str::replaceFirst('[', '[governorate_id', $name) : $name;
        // $this->cityName = Str::contains($name, '[]') ? Str::replaceFirst('[', '[city_id', $name) : $name .'[city_id]';
        $this->cityName = Str::contains($name, '[]') ? Str::replaceFirst('[', '[city_id', $name) : 'city_id';
        $this->governorates = $governorateService->getAllGovernorates();
    }

    public function render()
    {
        return view('components.governorates');
    }
}
