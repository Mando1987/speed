<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Grid extends Component
{
    public $cardColor;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cardColor)
    {
        //
        $this->cardColor = $cardColor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.grid');
    }
}
