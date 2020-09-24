<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $guarded = [];
    public $timestamps = false;


    public function order()
    {
        return $this->belongsTo(Order::class);
    }



    // public function setOrderNumAttribute($value = null)
    // {
    //     return $this->attributes['order_num'] = $this->order;
    // }

}
