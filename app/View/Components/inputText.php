<?php

namespace App\View\Components;

use Illuminate\View\Component;

class inputText extends Component
{
    public $name, $value, $placeHolder , $type;
    public $key;

    public function __construct($name , $value = null ,  $placeHolder = '' , $type = 'text' ,$key = '')
    {
        $this->name        = $name;
        $this->key         = \str_replace('[' , '.' ,\str_replace(']' , '' ,$name));
        $this->value       = $value ?? null;
        $this->placeHolder = $placeHolder;
        $this->type        = $type;
        $this->key         = $key;
    }

    public function render()
    {

        return view('components.input-text' ,['key' => 12345]);

    }
}
