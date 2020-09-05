<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;


class BaseService

{
    const ICON_SUCCESS  = 'success';
    const ICON_ERROR    = 'error';
    const TITLE_ADDED   = 'added';
    const TITLE_FAILED  = 'filed';
    const FOLDER_UPLOAD = '/uploads/images/';
    const DEFAULT_IMAGE = 'default.png';

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

  

}
