<?php
namespace App\Http\Interfaces;

use App\Http\Requests\PlaceStoreFormRequest;
use App\Http\Requests\PlaceUpdateFormRequest;

interface PlaceRepositoryInterface
{
    public function getAll();
    public function editMultiCites();
    public function updateMultiCites(PlaceUpdateFormRequest $placeUpdateFormRequest);
    // public function getById();
    public function create();
    public function store(PlaceStoreFormRequest $placeStoreFormRequest);
    // public function update();
    // public function print();
}
