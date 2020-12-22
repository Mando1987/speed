<?php
namespace App\Http\Services;

use App\Models\Reciver;

class getAllCities
{
    /**
     * get all recivers for any customer
     * @param integer $customerId
     * @return colection of Reciver
     */
    public function handle(int $customerId)
    {
        return Reciver::where('customer_id',$customerId)->get();
    }

}