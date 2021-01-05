<?php
namespace App\Http\Repositories\Places;

use App\Models\City;
use App\Models\PlacePrice;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;
use App\Http\Interfaces\PlacePricesRepositoryInterface;

class PlacePricesRepository implements PlacePricesRepositoryInterface
{
     private $placePrice;
    public $route;

    public function __construct(PlacePrice $placePrice, City $city, Governorate $governorate)
    {
        $this->governorate = $governorate;
        $this->city = $city;
        $this->placePrice = $placePrice;
    }
    public function getAll()
    {

    }
    public function store($request)
    {

        try {

            DB::beginTransaction();

            $newPlacePrice = $this->placePrice->where('city_id', $request->validated()['city_id']);

            ($newPlacePrice->exists()) ? $newPlacePrice->update($request->validated()) : $newPlacePrice->create($request->validated());
            DB::commit();

        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }
    }

    public function create($showInModel)
    {
        if ($showInModel == true) {
            $reciver = session('reciver');
            $data = ['governorate_id' => $reciver['governorate_id'], 'city_id' => $reciver['city_id']];
            return view('place-prices.create-in-model', $data);
        }

        return view('place-prices.create');
    }

    public function update($request, $cityId)
    {
        try {

            DB::beginTransaction();

            $city = $this->city::where('id', $cityId)->first();

            if (!$city->placePrices()->value('city_id')) {

                $city->placePrices->create($request->validated());

            } else {

                $city->placePrices->update($request->validated());
            }

            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
            return $this->path($this->route);

        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }

    }

    public function edit($id)
    {
        $city = $this->city::where('id', $id)->first();
        return view('place-prices.edit', [
            'city_price' => $city->placePrices,
            'city_name' => $city->name,
            'governorate_name' => $city->governorate->name,
        ]);
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
