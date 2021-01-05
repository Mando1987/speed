<?php

namespace App\Http\Controllers\Admin;

use App\Models\PlacePrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlacePriceEditFormRequest;
use App\Http\Requests\PlacePriceStoreFormRequest;
use App\Http\Interfaces\PlacePricesRepositoryInterface;


class PlacePricesController extends Controller
{
    private $placePricesRepository;

    public function __construct(PlacePricesRepositoryInterface $placePricesRepository)
    {
        $this->placePricesRepository = $placePricesRepository;
    }
    public function index(Request $request)
    {
        return $this->placePricesRepository->getAll($request);
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

    public function update(PlacePriceEditFormRequest $request, $cityId)
    {
        return $this->placePricesRepository->update($request, $cityId);
    }

    public function destroy($id)
    {
        PlacePrice::destroy($id);
        notify('success', 'deleted');
        return redirect()->route('price.index');
    }
}
