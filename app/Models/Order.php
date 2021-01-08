<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;
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

    public function statuses()
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
    public function getUserCanOpenOrder()
    {
        return  trans('site.order_print_user_can_open_order_' . $this->user_can_open_order);
    }

    public function scopeWithDefaultRealtions(Builder $builder)
    {
        $query =  $builder->select('id', 'reciver_id', 'customer_id', 'created_at', 'status')
               ->with(['reciver:id,fullname,phone,city_id', 'shipping' => function($q){
                 $q->select('id','order_id','charge_on','charge_price','order_num','customer_price', 'total_price');
            }]);
        return $query;
    }

    public function scopeWithCustomerRelationship(Builder $builder)
    {
        return $builder->with(['customer:id,fullname,phone,city_id', 'customer.city']);
    }
    public function scopeWithReciverCityRelationship(Builder $builder)
    {
        return $builder->with(['reciver.city']);
    }



}
