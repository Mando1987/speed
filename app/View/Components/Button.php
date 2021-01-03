<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{

    public $btnType = [
        'icon' => [
            'edit' => 'fas fa-pencil-alt',
            'add' => 'fas fa-plus',
            'delete' => 'far fa-trash-alt',
            'print' => 'fas fa-print',
            'view' => 'fas fa-eye',
            'default' => '',
        ],
        'color' => [
            'edit' => 'btn-info',
            'add' => 'btn-success',
            'delete' => 'btn-danger',
            'print' => 'btn-default',
            'view' => 'btn-primary',
            'default' => '',
        ],
    ];
    public $type;
    public $disabled;
    public $class;
    public $route;
    public $btnColor;
    public $btnIcon;
    public $text;

    public function __construct($type = 'default', $disabled = false, $class = '', $route = '', $text = '')
    {
        $this->type = $type;
        $this->disabled = $disabled == false ? null : true;
        $this->class = $class;
        $this->route = $route;
        $this->btnIcon = $this->btnType['icon'][$type];
        $this->btnColor = $this->btnType['color'][$type];
        $this->text = $text ? __($text) : '';
    }

    public function render()
    {
        return view('components.button');
    }
}
