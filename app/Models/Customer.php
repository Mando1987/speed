<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
    governorate_id
    city_id
    other_phone
    company_name
    facebook_page
    image
    contract_type
    admin_id
     *
     * @var array
     */
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

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
