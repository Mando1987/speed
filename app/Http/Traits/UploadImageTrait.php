<?php
namespace App\Http\Traits;

use Intervention\Image\Facades\Image;

trait UploadImageTrait
{
    private $mainFolderUpload = '/uploads/images/';
    private $defaultImage = 'default.png';

    protected function handeImageUploadUsingIntervention($image, $folder)
    {
        $image_path = public_path() . $this->mainFolderUpload . $folder;

        if (is_object($image)) {

            if (!file_exists($image_path)) {

                mkdir($image_path, 666, true);
            }
            $img = Image::make($image)->resize(150, 150, function ($constraint) {

                $constraint->aspectRatio();

            })->save($image_path . $image->hashName());

            return $img->basename;
        }
        return $this->defaultImage;

    }

}

