<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $gaurded =[];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
