<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\PlaceRepositoryInterface;
use App\Http\Requests\PlaceStoreFormRequest;
use App\Http\Requests\PlaceUpdateFormRequest;
use App\Http\Services\GovernorateService;
use App\Http\Traits\GovernorateTrait;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected $placeRepositoryInterface;

    public function __construct(PlaceRepositoryInterface $placeRepositoryInterface)
    {
        $this->placeRepositoryInterface = $placeRepositoryInterface;
    }

    public function index(Request $request)
    {
       return $this->placeRepositoryInterface->getAll($request);
    }

    public function create(Request $request)
    {
        return $this->placeRepositoryInterface->create($request);
    }

    public function store(PlaceStoreFormRequest $placeStoreFormRequest)
    {
        return $this->placeRepositoryInterface->store($placeStoreFormRequest);
    }

    public function editMultiCites(Request $request)
    {
        return $this->placeRepositoryInterface->editMultiCites($request);
    }
    public function updateMultiCites(PlaceUpdateFormRequest $placeUpdateFormRequest)
    {
        return $this->placeRepositoryInterface->updateMultiCites($placeUpdateFormRequest);
    }

    public function destroyMultiCities(Request $request)
    {
       return $this->placeRepositoryInterface->destroyMultiCities($request);
    }
    public function getCities(GovernorateService $governorateService)
    {
        return response()->json($governorateService->allCitiesForGovernorate(request('governorate_id')));
    }
}
