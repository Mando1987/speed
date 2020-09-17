<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DelegateDrive extends Model
{
    /**
    type
    color
    plate_number
    delegate_id
     */
    protected $guarded = [];

    public $timestamps = false;

    public function delegate()
    {
       return $this->belongsTo(Delegate::class);
    }

}
