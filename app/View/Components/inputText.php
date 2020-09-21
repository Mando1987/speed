<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputText extends Component
{
    public $name;
    public $value;
    public $placeholder;
    public $type ;
    public $key ;
    public function __construct($name , $value = null ,  $placeholder = '' , $type = 'text')
    {
        $this->name        = $name;
        $this->key         = \str_replace('[' , '.' ,\str_replace(']' , '' ,$name));
        $this->value       = $value ?? null;
        $this->placeholder = $placeholder;
        $this->type        = $type ?? 'text';
    }

    public function render()
    {
        return <<<'blade'
        <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="form-control @error($key) is-invalid @enderror"
        placeholder="{{ $placeholder }}">
        @error($key)
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
blade;
    }
}
