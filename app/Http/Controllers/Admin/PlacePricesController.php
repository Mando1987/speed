<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlacePrice;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\PlacePricesRepositoryInterface;
use App\Services\PlacePriceEditService;
use App\Http\Requests\PlacePriceEditFormRequest;
use App\Http\Requests\PlacePriceStoreFormRequest;
use App\Models\City;
use App\Services\Places\PlacePriceFetshDataService;
use App\Services\Places\PlacePriceCreateStoreService;
use App\Services\Places\PlacePriceEditUpdateService;

class PlacePricesController extends Controller
{
  private $placePricesRepository;

   public function __construct(PlacePricesRepositoryInterface $placePricesRepository)
   {
      $this->placePricesRepository = $placePricesRepository;
   }
    public function index()
    {
        return (request('governorate_id'));
    }

    public function create()
    {
        return $this->placePricesRepository->create(request('showInModel'));
    }

    public function store(PlacePriceStoreFormRequest $request)
    {
        return $this->placePricesRepository->store($request);
    }


    public function edit($id)
    {
        return $this->placePricesRepository->edit($id);

    }

    public function update(PlacePriceEditFormRequest $request ,$cityId)
    {
        return $this->placePricesRepository->update($request, $cityId);

    }

    public function destroy($id)
    {
        PlacePrice::destroy($id);
        notify('success', 'deleted');
        return  redirect()->route('price.index');
    }
}
