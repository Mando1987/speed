<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    // protected $casts = ['data' => 'object'];
    public function getDataAttribute($value)
    {
       return json_decode($value);
    }
}
