<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\PlacePrice;
use Illuminate\Support\Facades\DB;

class PlacePriceStoreService extends BaseService
{
    const IMAGE_PATH = 'customers/';

    private $placePrice;

    public function __construct(PlacePrice $placePrice)
    {
        $this->placePrice = $placePrice;
        $this->route = 'price.index';
    }

    public function handle($request)
    {
        //   dd($request);
        try {

            DB::beginTransaction();

            $newPlacePrice = $this->placePrice->where('city_id', $request->validated()['city_id']);

            ($newPlacePrice->exists()) ? $newPlacePrice->update($request->validated()) : $newPlacePrice->create($request->validated());


            DB::commit();
            if ($request->ajax()) {

                return response()->json([
                    'code'  => 200,
                    'title' => trans('site.added'),
                ]);
            }

            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
            return $this->path($this->route);
        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }
    }
}
