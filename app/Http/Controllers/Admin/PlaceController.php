<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\PlaceRepositoryInterface;
use App\Http\Traits\GovernorateTrait;

class PlaceController extends Controller
{
    use GovernorateTrait;

    protected $placeRepositoryInterface;

    public function __construct(PlaceRepositoryInterface $placeRepositoryInterface)
    {
        $this->placeRepositoryInterface = $placeRepositoryInterface;
    }

    public function index()
    {
       return $this->placeRepositoryInterface->getAll();
    }

    public function editMultiCites()
    {
        return $this->placeRepositoryInterface->editMultiCites();
    }
}
