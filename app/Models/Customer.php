<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }

    public function customerInfos()
    {
        return $this->hasOne(CustomerInfo::class);
    }
}
