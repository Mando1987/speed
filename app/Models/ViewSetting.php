<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewSetting extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function setDataAttribute($value)
    {
       $this->attributes['data'] = json_encode($value);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }
}
