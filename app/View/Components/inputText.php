<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Str;

class inputText extends Component
{
    public $name, $value, $placeHolder , $type , $key = '';

    // public function __construct($name , $value = null ,  $placeHolder = "" , $type = 'text' ,$key = 12345)
    // {
    //     $this->name        = $name;
    //     // $this->key         = \str_replace('[' , '.' ,\str_replace(']' , '' ,$name));
    //     $this->key         = $key;
    //     $this->value       = $value ?? null;
    //     $this->placeHolder = $placeHolder;
    //     $this->type        = $type;
    // }

    public function render()
    {
        return function (array $data) {
            $data['input-text'];
            $data['attributes'] = [
                'key' => 1234,
                'value' => 1234,
                'name' => 1234,

            ];
        return view('components.input-text');
        }
    }
}
