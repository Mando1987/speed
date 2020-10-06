<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrderFormRequestTrait;

class OrderStoreFormRequestByCustomer
{
     use OrderFormRequestTrait;

    public function rules()
    {
        if (session('page') == 1) {

            return $this->validateReciverInputs();

        } else {

            return [

                'order.type'                       => ['required', Rule::in($this->orderType)],
                'order.info'                       => ['required', 'string', 'max:150'],
                'order.notes'                      => ['nullable', 'string', 'max:150'],
                'order.user_can_open_order'        => ['required', 'in:1,0'],

                'shipping.weight'                  => ['required', 'string', 'max:6'],
                'shipping.quantity'                => ['required', 'integer'],
                'shipping.price'                   => ['required', 'string', 'max:6'],
                'shipping.charge_price'            => ['required', 'string', 'max:6'],
                'shipping.total_price'             => ['required', 'string', 'max:6'],
                'shipping.charge_on'               => ['required', 'in:sender,reciver'],
                'shipping.total_weight'            => ['required', 'string', 'max:6'],
                'shipping.total_over_weight'       => ['required', 'string', 'max:6'],
                'shipping.total_over_weight_price' => ['required', 'string', 'max:6'],
                // 'shipping.discount'                => ['nullable', 'string', 'max:6'],

            ];
        }
    }

    public function validated($order, $parentValidated)
    {
        if ($order) {

            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($parentValidated['shipping']);

            $data = array_merge(
                $parentValidated,
                [
                    'shipping' => $ChargePrice,
                    'reciver'  => session('reciver'),
                    'reciverAddress'  => session('reciverAddress'),
                    'order'    => array_merge($parentValidated['order'],['status' => 'under_review'])

                ]
            );
            return $data;
        }
        return $parentValidated;
    }
}
