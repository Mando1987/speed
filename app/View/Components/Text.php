<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Text extends Component
{

    public $name;

    public function __construct($name)
    {
      $this->name= $name;
    }


    public function render()
    {
        return <<<'blade'
<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    $name
</div>
blade;
    }
}
