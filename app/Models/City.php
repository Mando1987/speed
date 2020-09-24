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

    public function senders()
    {
        return $this->hasMany(Sender::class);
    }
    public function recivers()
    {
        return $this->hasMany(Reciver::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function delegates()
    {
        return $this->hasMany(Delegate::class);
    }


    public function getNameAttribute()
    {
        return (app()->getLocale() == 'ar') ? $this->city_name :  $this->city_name_en;
    }
}
