<?php

namespace App\View\Components;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Customers extends Component
{
    public $name;
    public $customers;
    public function __construct($name = 'customer_id')
    {
        $this->name = Str::contains($name, '[]')? Str::replaceFirst('[', '[customer_id', $name) : $name;
        $this->customers =Customer::all();
    }

    public function render()
    {
        return view('components.customers');
    }
}
