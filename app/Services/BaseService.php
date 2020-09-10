<?php

namespace App\Services;

use App\Models\City;
use App\Models\Governorate;
use Intervention\Image\Facades\Image;


class BaseService
{
    const ICON_SUCCESS  = 'success';
    const ICON_ERROR    = 'error';
    const TITLE_ADDED   = 'added';
    const TITLE_FAILED  = 'filed';
    const FOLDER_UPLOAD = '/uploads/images/';
    const DEFAULT_IMAGE = 'default.png';

    public $governorate, $route = 'price.index';

    public function __construct( Governorate $governorate)
    {
        $this->governorate = $governorate;

    }

    protected function path($route)
    {
        return redirect()->route($route);
    }

    protected function notify(array $array)
    {
       return session()->flash('notify' , [
           'icon' => $array['icon'] ,
           'title' => trans('site.' . $array['title'])
           ]) ;
    }

    protected function handeImageUploadUsingIntervention($image , $folder)
    {
        if(is_object($image)){

            $img = Image::make($image)->resize(150,150, function ($constraint) {

                $constraint->aspectRatio();

            })->save(public_path() . self::FOLDER_UPLOAD . $folder . $image->hashName());

            return $img->basename;
        }
        return self::DEFAULT_IMAGE;

    }
    public function getAllGovernorates()
    {
        return $this->governorate::all();

    }
    public function getAllGovernoratesAndCities()
    {

        $firstGovernoratesCities = $this->getAllGovernorates()->first()->cities;
        return  ['governorates' => $this->getAllGovernorates(), 'cities' => $firstGovernoratesCities];
    }

    public function getCities()
    {
         return  $this->governorate::findOrFail(request('governorate_id'))->cities()->get();
    }



}
