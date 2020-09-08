<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\GovernorateTrait;
use Illuminate\Http\Request;

class PlacePricesController extends Controller
{
    use GovernorateTrait;

    public function create()
    {
        return view('place-prices.create' , $this->getAllGovernoratesAndCities());
    }
}
