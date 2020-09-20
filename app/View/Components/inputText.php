<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Str;

class inputText extends Component
{
    public $name, $value, $placeHolder , $type , $key = '';

    public function __construct($name ,$value = null ,  $placeHolder = "" , $type = 'text')
    {
        $this->name        = $name;
        // $this->key         = \str_replace('[' , '.' ,\str_replace(']' , '' ,$name));
        $this->key         = 12345;
        $this->value       = $value ?? null;
        $this->placeHolder = $placeHolder;
        $this->type        = $type;
    }

    public function render()
    {
        return view('components.input-text');
    }
}
