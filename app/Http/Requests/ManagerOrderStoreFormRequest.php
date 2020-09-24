<?php

namespace App\Http\Requests;

use App\Services\Orders\OrderFormRequestTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManagerOrderStoreFormRequest extends FormRequest
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
            'sender.fullname' => 'required|string|max:50',
            'sender.phone' => ['required', 'unique:senders,phone'],
            'sender.governorate_id' => 'required|exists:governorates,id',
            'sender.address' => 'required|string',
            'sender.special_marque' => 'required|string|max:100',
            'sender.house_number' => 'required|string|max:10',
            'sender.door_number' => 'required|string|max:10',
            'sender.shaka_number' => 'required|string|max:10',
            'sender.city_id' => 'required|exists:cities,id',
            'sender.other_phone' => ['nullable', 'max:11', 'unique:senders,other_phone'],
        ];
    }

    public function validated()
    {
        if ($this->order) {

            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($this->validator->validated()['shipping']);

            $data = array_merge(
                $this->validator->validated(),
                [
                    'shipping' => $ChargePrice,
                    'sender' => session('sender'),
                    'reciver' => session('reciver'),
                ]
            );
            return $data;
        }
        return $this->validator->validated();
    }
}
