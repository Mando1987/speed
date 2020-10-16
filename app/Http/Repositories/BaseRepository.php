<?php
namespace App\Http\Repositories;

use App\Http\Traits\IdentifyTrait;
use App\Models\Governorate;
use Intervention\Image\Facades\Image;

class BaseRepository
{
    const ICON_SUCCESS = 'success';
    const ICON_ERROR = 'error';
    const TITLE_ADDED = 'added';
    const TITLE_EDITED = 'edited';
    const TITLE_DELETED= 'deleted';
    const TITLE_FAILED = 'filed';
    const FOLDER_UPLOAD = '/uploads/images/';
    const DEFAULT_IMAGE = 'default.png';
    const PAGINATE_NUM = 12;

    protected $route = 'dashboard.index';
    protected function path($route)
    {
        return redirect()->route($route);
    }

    protected function notify(array $array)
    {
        return session()->flash('notify', [
            'icon' => $array['icon'],
            'title' => trans('site.' . $array['title']),
        ]);
    }

    protected function handeImageUploadUsingIntervention($image, $folder)
    {
        $image_path = public_path() . self::FOLDER_UPLOAD . $folder;

        if (is_object($image)) {

            if (!file_exists($image_path)) {

                mkdir($image_path, 666, true);
            }
            $img = Image::make($image)->resize(150, 150, function ($constraint) {

                $constraint->aspectRatio();

            })->save($image_path . $image->hashName());

            return $img->basename;
        }
        return self::DEFAULT_IMAGE;

    }
    public function getAllGovernorates()
    {
        return Governorate::all();

    }
    public function getAllGovernoratesAndCities()
    {

        $firstGovernoratesCities = $this->getAllGovernorates()->first()->cities;
        return ['governorates' => $this->getAllGovernorates(), 'cities' => $firstGovernoratesCities];
    }

    public function getCities()
    {
        return Governorate::findOrFail(request('governorate_id'))->cities()->get();
    }

    public function viewWithGovernorates($route, array $data = [])
    {
        return view($route, array_merge($this->getAllGovernoratesAndCities(), $data));
    }
    public function forgetOrderData()
    {
       return  session()->forget([
            'customer', 'reciver', 'page', 'customerAddress' , 'reciverAddress','chooseType'
        ]);
    }

}
