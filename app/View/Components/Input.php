<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $value;
    public $placeholder;
    public $type ;
    public $key ;
    public function __construct($name = '', $value = '' ,  $placeholder = '' , $type = 'text')
    {
        $this->name        = $name;
        $this->key         = \str_replace('[' , '.' ,\str_replace(']' , '' ,$name));
        $this->value       = $value ?? '';
        $this->placeholder = $placeholder;
        $this->type        = $type ?? 'text';
    }

    public function render()
    {
        return <<<'blade'
        <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="form-control"
        placeholder="{{ $placeholder }}" {{ $attributes }}>
       blade;
    }
}
