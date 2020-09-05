<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    protected $hidden = ['pivot'];

    public function role()
    {
       return $this->belongsToMany(Role::class);
    }

    
}
