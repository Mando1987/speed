<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function customer()
    {
       return $this->belongsTo(Customer::class);
    }
}
