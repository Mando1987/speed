<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'data' => 'object',
    ];

    public function setDataAttribute($value)
    {
       $this->attributes['data'] = json_encode($value);
    }
}
