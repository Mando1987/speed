<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputText extends Component
{
    public $name, $value, $placeHolder , $type;
    public $mando;

    public function __construct($name , $value = null ,  $placeHolder = '' , $type = 'text' ,$mando = '')
    {
        $this->name        = $name;
        $this->mando         = \str_replace('[' , '.' ,\str_replace(']' , '' ,$name));
        $this->value       = $value ?? null;
        $this->placeHolder = $placeHolder;
        $this->type        = $type;
        $this->mando         = $mando;
    }

    public function render()
    {

        return view('components.input-text' ,['mando' => 12345]);

    }
}
