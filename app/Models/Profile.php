<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['email' ,'phone' , 'address' , 'city' ];
    
    public $timestamps = false;

    public function profilable()
    {
        return $this->morphTo();
    }
}
