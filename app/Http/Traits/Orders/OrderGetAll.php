<?php
namespace App\Http\Traits\Orders;

use App\Models\Order;
use Illuminate\Http\Request;

trait OrderGetAll
{

    public function filterData($request)
    {
        $orders = $this->query->when(true,function($qq){
            $filter = $qq->orWhereHas('customer.city' ,function($q){
                $q->where('city_name' ,'LIKE' ,"%15%");
            });
            return $filter;
         });

         return $orders;
    }
}
