<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reciver extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
