<?php
namespace App\Http\Repositories\Places;

use App\Http\Interfaces\PlacePricesRepositoryInterface;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Traits\ViewSettingTrait;
use App\Models\City;
use App\Models\Governorate;
use App\Models\PlacePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacePricesRepository implements PlacePricesRepositoryInterface
{
    use ViewSettingTrait;
    private $placePrice;
    public $route;

    public function __construct(PlacePrice $placePrice, City $city, Governorate $governorate)
    {
        $this->governorate = $governorate;
        $this->city = $city;
        $this->placePrice = $placePrice;
    }
    public function getAll(Request $request)
    {
        $prices = $this->placePrice->with('city')->paginate($this->paginate);
        return view('place-prices.index', [
            'prices' => $prices,
            'view' => 'grid' ?? $this->view,
        ]
        );
    }
    public function store($request)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $this->placePrice->updateOrCreate($data['checkedDate'], $data['updatedData']);
            DB::commit();
            return AlertFormatedDataJson::alertBodyDefault('price');

        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('price.create');
        }
    }

    public function create($showInModel)
    {
        return view('place-prices.create');
    }
    public function edit($id)
    {
        $placePrice = $this->placePrice::findOrFail($id);
        return view('place-prices.edit', ['placePrice' => $placePrice]);
    }
    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            DB::beginTransaction();
            $this->placePrice->find($id)->update($data);
            DB::commit();
            return AlertFormatedDataJson::alertBodyDefault('price', 'site.edited');
        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertServerError('price.create');
        }

    }


    public function getGovernorateCitiesPrice($governorate_id)
    {
        $gov_id = $governorate_id ? $governorate_id : 1;

        $governorateCitiesPrice = $this->city::where('governorate_id', $gov_id)->with('placePrices')->paginate(12);
        return view('place-prices.index', [
            'governorateCitiesPrice' => $governorateCitiesPrice,
            'governorates' => $this->getAllGovernorates(),
            'selectedGovId' => $gov_id,
        ]);
    }

    public function getAllGovernorates()
    {
        return $this->governorate::all();
    }
    public function getAllGovernoratesAndCities()
    {

        $firstGovernoratesCities = $this->getAllGovernorates()->first()->cities;
        return ['governorates' => $this->getAllGovernorates(), 'cities' => $firstGovernoratesCities];
    }

    public function getCities()
    {
        return $this->governorate::findOrFail(request('governorate_id'))->cities()->get();
    }
}
