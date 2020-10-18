<?php

namespace App\Models;

use App\Http\Traits\AddressMorph;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use AddressMorph;
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function recivers()
    {
        return $this->hasMany(Reciver::class);
    }

}
