<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{

    protected $guarded = ['is_active'];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function delegateDrive()
    {
        return $this->hasOne(DelegateDrive::class);
    }
    public function statuses()
    {
       return $this->hasMany(OrderStatus::class);
    }

}
