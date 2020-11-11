<?php

namespace App\View\Components;

use Illuminate\View\Component;

class eidtButton extends Component
{
    public $route;
    public $class;
    public $disabled;

    public function __construct($route, $class ='', $disabled = false)
    {
        $this->route = $route;
        $this->class = $class;
        $this->disabled = $disabled;
    }

    public function render()
    {
        return view('components.eidt-button');
    }
}
