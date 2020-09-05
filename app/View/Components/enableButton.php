<?php

namespace App\View\Components;

use Illuminate\View\Component;

class enableButton extends Component
{
    public $route;
    public $id;
    
    public $isActive;

   public function __construct($route ,$id ,$isActive )
   {
     $this->route     = $route ;  
     $this->id        = $id ;  
     $this->isActive = $isActive ;
     

   }

    public function render()
    {
        return view('components.enable-button');
    }
}
