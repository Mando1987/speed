<?php

namespace App\View\Components;

use App\DryClasses\GovernorateClass;
use App\Models\Governorate;
use Illuminate\Support\Str;

use Illuminate\View\Component;

class Governorates extends Component
{
    public $name;
    public $governorates;
    public function __construct($name = 'governorate_id', GovernorateClass $governorateClass)
    {
        $this->name = Str::contains($name, '[]')? Str::replaceFirst('[', '[governorate_id', $name) : $name;
        $this->governorates = $governorateClass->getAllGovernorates();
    }

    public function render()
    {
        return view('components.governorates');
    }
}
