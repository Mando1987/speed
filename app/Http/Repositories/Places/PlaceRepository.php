<?php
namespace App\Http\Repositories\Places;

use App\Http\Interfaces\PlaceRepositoryInterface;
use App\Http\Repositories\BaseRepository;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class PlaceRepository extends BaseRepository implements PlaceRepositoryInterface
{

    protected $city;
    protected $request;
    protected $governorate;

    public function __construct(City $city, Request $request, Governorate $governorate)
    {
        $this->city = $city;
        $this->request = $request;
        $this->governorate = $governorate;
    }

    public function getAll()
    {
        $cities = $this->city::where(function ($query) {
            $query->where('governorate_id', $this->request->governorate ?? 1);
        })->paginate(15);
        return view('place.index',
            [
                'cities' => $cities,
                'view' => 'list',
                'selectedGovId' => 1,
                'governorates' => $this->governorate::get()
            ]);
    }

    public function editMultiCites()
    {
        $cities = $this->city::where(function ($query) {
            $query->where('governorate_id', $this->request->governorate ?? 1)
                ->whereIn('id', $this->request->cities);
        })->get();

        return $cities;
    }
}
