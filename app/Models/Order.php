<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
        المالية مغلقة
        تسليم النقديه - الأموال المحولة إلى العميل
        المحصلة - الأموال المحصلة
        الشحنه فى الطريق للمخزن
        الشحنه فى طريق العوده الى للمخزن
        الشحنه فى الطريق للعميل
        خارج للتوصيل
        شحنه تم تسليمها
        العميل غير متوفر
        تأجيل موعد التسليم
        عنوان جديد
        العميل رفض الأستلام
        في الانتظار
        عنوان خاطئ
     *
     *
     */
    protected $guarded = [];

    // protected $casts = [
    //     'created_at' => 'date:Y-m-d',
    // ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sender()
    {
        return $this->belongsTo(Sender::class);
    }

    public function reciver()
    {
        return $this->belongsTo(Reciver::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function getTypeAttribute($value)
    {
        return trans('site.order_' . $value);
    }

    public function getStatusAttribute($value)
    {
        return trans('site.order_status_' . $value);
    }

    public function getDate()
    {
       return $this->created_at->format('Y-m-d');
    }


}
