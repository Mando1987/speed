<?php

namespace App\View\Components;

use App\DryClasses\GovernorateClass;
use App\Models\Governorate;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Cities extends Component
{
    public $name;
    public $selected;
    public $cities;

    public function __construct($name = 'city_id', $selected = 1, GovernorateClass $governorateClass)
    {
        $this->name = Str::contains($name, '[]') ? Str::replaceFirst('[', '[city_id', $name) : $name;
        $this->selected = $selected;
        $this->cities = $governorateClass->getGovernorateWithCities();
    }

    public function render()
    {
        return view('components.cities');
    }
}
