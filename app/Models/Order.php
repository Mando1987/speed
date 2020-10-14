<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function reciver()
    {
        return $this->belongsTo(Reciver::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function orderStatuses()
    {
       return $this->hasMany(OrderStatus::class);
    }

    public function getType()
    {
        return trans('site.order_' . $this->type);
    }

    public function getStatus()
    {
        return trans('site.order_status_' . $this->status);
    }

    public function getOpenOrder()
    {
        return trans('site.order_user_can_open_order_'. $this->user_can_open_order);
    }

    public function scopeWithRealtionsTables(Builder $builder)
    {
        $query = $builder->select('id', 'reciver_id', 'customer_id', 'created_at', 'status')
               ->with(['reciver:id,fullname,phone,city_id', 'shipping' => function($q){
                 $q->select('id','order_id','charge_on','charge_price','order_num','customer_price', 'total_price');
            }]);
         (request()->adminType == 'manager') ?
           $query->with(['customer:id,fullname,phone,city_id', 'customer.city']) :
           $query->with(['reciver.city']);
           return $query;

    }

    public function scopeWhereAdminIsCustomer(Builder $builder)
    {
        return $builder->when(request()->adminType == 'customer' , function($query){
            $query->where('orders.customer_id',request()->adminId);
        });
    }


}
