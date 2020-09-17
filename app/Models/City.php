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
        return $this->belongsTo(Governorate::class);
    }
    public function placePrices()
    {
        return $this->hasOne(PlacePrice::class)->withDefault(
            [
                'governorate_id'  => $this->governorate_id,
                'send_weight'     => '0',
                'send_price'      => '0',
                'weight_addtion'  => '0',
                'price_addtion'   => '0',
            ]
        );
    }

    public function sender()
    {
        return $this->hasOne(Sender::class);
    }

    public function getNameAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->city_name :  $this->city_name_en;
    }
}
