<?php

namespace App\Http\Requests;

use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrderFormRequestTrait;
use Illuminate\Validation\Rule;

class OrderStoreFormRequestByManager
{
    use OrderFormRequestTrait;

    public function rules()
    {
        if (session('page') == 1) {

            return $this->validateSenderInputs();
        } elseif (session('page') == 2) {

            return $this->validateReciverInputs();
        } else {

            return [

                'order.type' => ['required', Rule::in($this->orderType)],
                'order.status' => ['required', Rule::in($this->orderStatus)],
                'order.info' => ['required', 'string', 'max:150'],
                'order.notes' => ['nullable', 'string', 'max:150'],
                'order.user_can_open_order' => ['required', 'in:1,0'],

                'shipping.weight' => ['required', 'string', 'max:6'],
                'shipping.quantity' => ['required', 'integer'],
                'shipping.price' => ['required', 'string', 'max:6'],
                'shipping.charge_price' => ['required', 'string', 'max:6'],
                'shipping.total_price' => ['required', 'string', 'max:6'],
                'shipping.charge_on' => ['required', 'in:sender,reciver'],
                'shipping.total_weight' => ['required', 'string', 'max:6'],
                'shipping.total_over_weight' => ['required', 'string', 'max:6'],
                'shipping.total_over_weight_price' => ['required', 'string', 'max:6'],
                'shipping.discount' => ['nullable', 'string', 'max:6'],

            ];
        }
    }

    private function validateSenderInputs()
    {
        return [
            'customer.fullname' => 'required|string|max:50',
            'customer.phone' => ['required', 'unique:customers,phone'],
            'customer.other_phone' => ['nullable', 'max:11', 'unique:customers,other_phone'],
            'customer.governorate_id' => 'required|exists:governorates,id',
            'customer.city_id' => 'required|exists:cities,id',

            'address.address' => 'required|string',
            'address.special_marque' => 'required|string|max:100',
            'address.house_number'   => 'required|string|max:10',
            'address.door_number'    => 'required|string|max:10',
            'address.shaka_number'   => 'required|string|max:10',
        ];
    }

    public function validated($order, $parentValidated)
    {
        if ($order) {

            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($parentValidated['shipping']);

            $data = array_merge(
                $parentValidated,
                [
                    'shipping' => $ChargePrice,
                    'customer' => session('customer'),
                    'reciver'  => session('reciver'),
                    'customerAddress' => session('customerAddress'),
                    'reciverAddress'  => session('reciverAddress'),
                ]
            );
            return $data;
        }
        return $parentValidated;
    }
}
