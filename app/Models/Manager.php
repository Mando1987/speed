<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{

    protected $guarded = [];
    public $timestamps = false;

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

}
