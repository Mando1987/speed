<?php

namespace App\View\Components;

use Illuminate\View\Component;

class deleteButton extends Component
{
    public $route;
    public $id;
    public $ability;

   public function __construct($route ,$id ,$ability)
   {
     $this->route   = $route ;  
     $this->id      = $id ;  
     $this->ability = $ability ;  
   }

    public function render()
    {
        return view('components.delete-button');
    }
}
