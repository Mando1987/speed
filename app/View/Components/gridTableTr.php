<?php

namespace App\View\Components;

use Illuminate\View\Component;

class gridTableTr extends Component
{
    public $key;
    public $value;

    public $lastTdClass;

    public $firstTdClass;

    public function __construct($key, $value, $lastTdClass = '', $firstTdClass = '')
    {
        $this->key = $key;
        $this->value = $value;
        $this->lastTdClass = $lastTdClass;
        $this->firstTdClass = $firstTdClass;
    }

    public function render()
    {
        return view('components.grid-table-tr');
    }
}
