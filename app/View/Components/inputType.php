<?php

namespace App\View\Components;

use Illuminate\View\Component;

class input extends Component
{

    public $name = 123;
    public $value = 123;
    public $key = 123;
    public function __construct()
    {

    }

    public function render()
    {
        return <<<'blade'
        <input type="{$type}" name="{{ $name }}" value="{{ $value }}" class="form-control @error($key) is-invalid @enderror"
        place_holder="{{ $placeholder ?? '' }}" >
        @error($key)
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
      blade;
    }
}
