<?php
namespace App\Services\Places;

use App\Models\City;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class PlacePriceEditUpdateService extends BaseService
{
    const IMAGE_PATH = 'customers/';

    public $city, $route = 'price.index';

    public function __construct(City $city)
    {

        $this->city = $city;
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

}
