<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\PlaceRepositoryInterface;
use App\Http\Requests\PlaceStoreFormRequest;
use App\Http\Requests\PlaceUpdateFormRequest;
use App\Http\Traits\GovernorateTrait;
use Illuminate\Http\Request;

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

    public function create()
    {
        return $this->placeRepositoryInterface->create();
    }

    public function store(PlaceStoreFormRequest $placeStoreFormRequest)
    {
        return $this->placeRepositoryInterface->store($placeStoreFormRequest);
    }

    public function editMultiCites()
    {
        return $this->placeRepositoryInterface->editMultiCites();
    }
    public function updateMultiCites(PlaceUpdateFormRequest $placeUpdateFormRequest)
    {
        return $this->placeRepositoryInterface->updateMultiCites($placeUpdateFormRequest);
    }

    public function destroyMultiCities()
    {
       return $this->placeRepositoryInterface->destroyMultiCities();
    }
}
