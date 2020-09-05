<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $gaurded = [];
    public function governorate()
    {
        return $this->hasOne(Governorate::class);
    }
}
