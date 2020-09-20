<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Str;

class inputText extends Component
{
    public $name, $value, $placeholder , $type , $key = '';

    public function __construct($name ,$value = null ,  $placeholder = "" , $type = 'text')
    {
        $this->name        = $name;
        $this->key         = str_replace('[' , '.' ,str_replace(']' , '' ,$name));
        $this->value       = $value ?? '';
        $this->placeholder = $placeholder;
        $this->type        = $type;
    }

    public function render()
    {
        return view('components.input-text');
    }
}
