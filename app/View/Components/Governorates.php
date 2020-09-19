<?php

namespace App\View\Components;

use App\Models\Governorate;
use Illuminate\Support\Str;

use Illuminate\View\Component;
use function PHPSTORM_META\type;

class Governorates extends Component
{
    public $name;
    public $selected;
    public $governorates;
    public function __construct($name = 'governorate_id', $selected = 1)
    {
        $this->name = Str::contains($name, '[]')? Str::replaceFirst('[', '[governorate_id', $name) : $name;
        $this->selected = $selected;

        $this->governorates =Governorate::all();
    }

    public function render()
    {
        return view('components.governorates');
    }
}
