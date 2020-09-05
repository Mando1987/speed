<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //id, event, type, details, admin_id , created_at, updated_at
    protected $guarded = [];

    public function admin()
    {
       return $this->belongsTo(Admin::class);
    }

}
