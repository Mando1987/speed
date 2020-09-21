<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Text extends Component
{

    public $name;

    public function __construct($name = 'mando')
    {
      $this->name= $name;
    }


    public function render()
    {
        return <<<'blade'
<div>

    {{$name}}
</div>
blade;
    }
}
