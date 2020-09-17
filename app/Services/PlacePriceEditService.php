<?php

namespace App\Services;

use App\Models\City;
use App\Models\PlacePrice;
use Illuminate\Support\Facades\DB;

class PlacePriceEditService extends BaseService
{
    const IMAGE_PATH = 'customers/';

    private $city, $route = 'price.index';

    public function __construct(City $city){

        $this->city = $city;
    }


    public function handle($request ,$cityId)
    {
        try {

            DB::beginTransaction();

            $city = $this->city::where('id',$cityId)->first();

            if (!$city->placePrices()->value('city_id')){

                $city->placePrices->create($request);

            }else{

                $city->placePrices->update($request);
            }

            DB::commit();
            $this->notify(['icon' => self::ICON_SUCCESS ,'title' => self::TITLE_ADDED]);
            return $this->path($this->route);

        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR ,'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }

    }

}
