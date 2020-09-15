<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
