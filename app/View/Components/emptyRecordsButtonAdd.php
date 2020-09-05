<?php

namespace App\View\Components;

use Illuminate\View\Component;

class emptyRecordsButtonAdd extends Component
{
    public $route;
    public function __construct($route)
    {
        $this->route = $route;
    }

    
    public function render()
    {
        return view('components.empty-records-button-add');
    }
}
