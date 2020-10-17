<?php
namespace App\Http\Interfaces;

use App\Http\Requests\PlaceStoreFormRequest;
use App\Http\Requests\PlaceUpdateFormRequest;
use Illuminate\Http\Request;

interface PlaceRepositoryInterface
{
    public function getAll(Request $request);
    public function editMultiCites(Request $request);
    public function updateMultiCites(PlaceUpdateFormRequest $placeUpdateFormRequest);
    public function create(Request $request);
    public function store(PlaceStoreFormRequest $placeStoreFormRequest);
    public function destroyMultiCities(Request $request);

}
