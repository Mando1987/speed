<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrderFormRequestTrait;

class CustomerOrderStoreRequest extends FormRequest
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

    public function validated()
    {
        if ($this->order) {

            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($this->validator->validated()['shipping']);

            $data = array_merge(
                $this->validator->validated(),
                [
                    'shipping' => $ChargePrice,
                    'reciver'  => session('reciver'),
                    'order'    => array_merge($this->validator->validated()['order'],['status' => 'under_review'])

                ]
            );
            return $data;
        }
        return $this->validator->validated();
    }
}
