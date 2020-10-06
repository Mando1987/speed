<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function addressable()
    {
      return $this->morphTo();
    }
}
