<?php
namespace App\Services\Places;

use App\Models\PlacePrice;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class PlacePriceCreateStoreService extends BaseService
{
    const IMAGE_PATH = 'customers/';

    private $placePrice;

    public function __construct(PlacePrice $placePrice)
    {
        $this->placePrice = $placePrice;
        $this->route = 'price.index';
    }

    public function store($request)
    {

        try {

            DB::beginTransaction();

            $newPlacePrice = $this->placePrice->where('city_id', $request->validated()['city_id']);

            ($newPlacePrice->exists()) ? $newPlacePrice->update($request->validated()) : $newPlacePrice->create($request->validated());

            DB::commit();
            if ($request->ajax()) {

                return response()->json([
                    'code' => 200,
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

    public function create($showInModel)
    {
        if ($showInModel == true) {
            $reciver = session('reciver');
            $data = ['governorate_id' => $reciver['governorate_id'], 'city_id' => $reciver['city_id']];
            return view('place-prices.create-in-model', $data);
        }

        return view('place-prices.create', $this->getAllGovernoratesAndCities());
    }
}
