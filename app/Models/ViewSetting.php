<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewSetting extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function setContentAttribute($value)
    {
       $this->attributes['content'] = json_encode($value);
    }

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }
}
