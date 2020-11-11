<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $name;

    public function __construct()
    {
        //
      //  $this->name = $name;
    }

    public function render()
    {
        return view('components.card');
    }
}
