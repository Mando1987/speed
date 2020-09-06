<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    protected $appends = ['name'];
    protected $hidden  = ['city_name', 'city_name_en'];
    public function governorate()
    {
        return $this->hasOne(Governorate::class);
    }
    public function getNameAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->city_name :  $this->city_name_en;
    }
}
