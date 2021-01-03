<?php
namespace App\Http\Traits\Orders;

trait OrderGetAll
{
    public function filterData($request)
    {
        return $this->query->when(true, function ($qq) {
            return $qq->orWhereHas('customer.city', function ($q) {
                $q->where('city_name', 'LIKE', "%15%");
            });
        });
    }
}
