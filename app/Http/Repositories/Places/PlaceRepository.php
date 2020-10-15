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

class PlaceRepository extends BaseRepository implements PlaceRepositoryInterface
{
    const DEFAULT_PAGINATE = 10;
    protected $city;
    protected $request;
    protected $governorate;
    private $paginate;
    private $search;
    private $governorate_id;
    protected $route = 'place.index';

    public function __construct(City $city, Request $request, Governorate $governorate)
    {
        $this->city = $city;
        $this->request = $request;
        $this->governorate = $governorate;
    }

    public function getAll()
    {
        $this->governorate_id = $this->request->governorate_id ?? 1;
        $this->paginate = $this->request->paginate ?? static::DEFAULT_PAGINATE;
        $this->search = $this->request->search ?? false;

        $cities = $this->city::where(function ($query) {
            $query->where('governorate_id', $this->governorate_id)->where(function ($q) {
                return $q->when($this->search, function ($qsearsh) {
                    return $qsearsh->where('city_name', 'LIKE', "%{$this->search}%")
                        ->orWhere('city_name_en', 'LIKE', "%{$this->search}%");
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

    public function editMultiCites()
    {
        $governorate_id = $this->request->governorate_id ?? 1;

        $cities_ids = Arr::where(explode(',', $this->request->cities), function ($value, $key) {
            return (int) $value;
        });

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

            $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_EDITED]);
            return $this->path($this->route);
        } catch (\Exception $ex) {

            DB::rollback();
            $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

            dd($ex->getMessage());
            return back();
        }
    }

    public function create()
    {
        $city_count = ($this->request->city_count && $this->request->city_count > 0) ? $this->request->city_count : 1;
        return view('place.create', ['city_count' => $city_count]);
    }

    public function store(PlaceStoreFormRequest $placeStoreFormRequest)
    {

        try {

            DB::beginTransaction();
            $this->city::insert($placeStoreFormRequest->validated()['cities']);
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
}
