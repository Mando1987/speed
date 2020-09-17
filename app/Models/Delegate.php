<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    /**
     fullname
     national_id
     phone
     governorate_id
     address

    qualification
    social_status
    other_phone
    city_id
    image
    national_image
     */
    protected $guarded = [];

    public function delegateDrive()
    {
        return $this->hasOne(DelegateDrive::class);
    }
}
