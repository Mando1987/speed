<?php
namespace App\Http\Traits\Orders;

use App\Models\Reciver;

trait GetAllRecivers
{
    /**
     * get all recivers for customer
     *
     * @param integer $customerId
     *
     * @return array
     */
    public static function getRecivers(int $customerId) : object
    {
        if ($customerId > 0) {
            $recivers = Reciver::select('id', 'fullname')->where('customer_id', $customerId)->get();
            if ($recivers->count() > 0) {
                return $recivers;
            }
        }
        return (object) [['id' => null, 'fullname' => trans('site.no_recivers_for_customer')]];
    }
}

