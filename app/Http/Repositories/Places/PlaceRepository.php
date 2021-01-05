<?php
namespace App\Http\Repositories\Places;

use App\Http\Interfaces\PlaceRepositoryInterface;
use App\Http\Repositories\BaseRepository;
use App\Http\Requests\PlaceStoreFormRequest;
use App\Http\Requests\PlaceUpdateFormRequest;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PlaceRepository implements PlaceRepositoryInterface
{
    private $paginateCount = 10;
    protected $city;
    protected $governorate;
    private $paginate;
    private $search;
    private $governorate_id;
    protected $route = 'place.index';

    public function __construct(City $city, Governorate $governorate)
    {
        $this->city = $city;
        $this->governorate = $governorate;
    }

    public function getAll(Request $request)
    {
        $this->governorate_id = $request->governorate_id ?? 1;
        $this->paginate = $request->paginate ?? $this->paginateCount;
        $this->search = $request->search ?? false;

        $cities = $this->city::with('governorate')->where(function ($query) {
            $query->where(function ($q) {
                return $q->when($this->search, function ($qsearsh) {
                    return $qsearsh->where('city_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('city_name_en', 'LIKE', "%{$this->search}%");
                })->when(!$this->search, function ($qWithGovernorate) {
                    return $qWithGovernorate->where('governorate_id', $this->governorate_id);
                });
            });
        })->paginate($this->paginate);

        // return $cities;
        return view('place.index',
            [
                'cities' => $cities,
                'governorate_id' => $this->governorate_id,
                'search' => $this->search,
                'governorates' => $this->governorate::get(),
            ]);
    }

    public function editMultiCites(Request $request)
    {
        $governorate_id = $request->governorate_id ?? 1;

        $cities_ids = $this->getCitiesIdFromString($request);

        $cities = $this->city::where(function ($query) use ($governorate_id, $cities_ids) {
            $query->where('governorate_id', $governorate_id)
                ->whereIn('id', $cities_ids);
        })->get();

        $cities->makeVisible(['city_name', 'city_name_en']);

        return view('place.editMultiCities',
            [
                'cities' => $cities,
                'governorate_id' => $governorate_id,

            ]
        );
    }

    public function updateMultiCites(PlaceUpdateFormRequest $placeUpdateFormRequest)
    {
        try {

            DB::beginTransaction();
            $cities = $placeUpdateFormRequest->validated()['cities'];
            foreach ($cities as $city_id => $city) {
                $this->city::where('id', $city_id)->update(
                    array_merge($city, ['governorate_id' => $placeUpdateFormRequest->governorate_id])
                );
            }
            DB::commit();


        } catch (\Exception $ex) {

            DB::rollback();

            dd($ex->getMessage());
            return back();
        }
    }

    public function create(Request $request)
    {
        $city_count = ($request->city_count && $request->city_count > 0) ? $request->city_count : 1;
        return view('place.create', ['city_count' => $city_count]);
    }

    public function store(PlaceStoreFormRequest $placeStoreFormRequest)
    {

        try {

            DB::beginTransaction();
            $this->city::insert($placeStoreFormRequest->validated()['cities']);
            DB::commit();


        } catch (\Exception $ex) {
            DB::rollback();
        }
    }

    public function destroyMultiCities(Request $request)
    {
        try {
            DB::beginTransaction();
            $cities_ids = $this->getCitiesIdFromString($request);

            $citiesAreSaveDeleted = $this->city->whereIn('id', $cities_ids)
                ->whereDoesntHave('customers')
                ->whereDoesntHave('recivers')->get();
            $citiesAreSaveDeleted->map(function ($city) {
                $city->delete();
            });

            DB::commit();

            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_DELETED]);
            return $this->path($this->route);
        } catch (\Exception $ex) {
            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }
    }

    private function getCitiesIdFromString(Request $request)
    {
        return Arr::where(explode(',', $request->cities_ids), function ($value, $key) {
            return (int) $value;
        });
    }
}
