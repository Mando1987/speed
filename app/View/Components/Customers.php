<?php

namespace App\View\Components;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Customers extends Component
{
    public $name;
    public $selected;
    public $customers;
    public function __construct($name = 'customer_id', $selected = 1)
    {
        $this->name = Str::contains($name, '[]')? Str::replaceFirst('[', '[customer_id', $name) : $name;
        $this->selected = $selected;

        $this->customers =Customer::all();
    }

    public function render()
    {
        return view('components.customers');
    }
}
