<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    /**
     *  [1] possibility_of_delivery امكانيه التسليم
     *  [2] Receipt_from_the_customer الاستلام من العميل
     *  [3] storage التخزين
     *  [4] Delivery_to_the_customer التسليم الى العميل
     *  [5] Treasury الخزنة
     *  [6] cash النقدية
     *  [6] customer_termination الانتهاء
     *
     *
     */
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
