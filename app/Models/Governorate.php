<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $guarded = [];
    protected $hidden  = ['governorate_name' , 'governorate_name_en'];
    protected $appends = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function getNameAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->governorate_name :  $this->governorate_name_en;

    }
}
