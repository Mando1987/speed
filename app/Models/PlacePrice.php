<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlacePrice extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

}
