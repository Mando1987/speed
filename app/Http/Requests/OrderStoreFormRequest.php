<?php

namespace App\Http\Requests;

use App\Services\Orders\OrderCountChargePrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class OrderStoreFormRequest extends FormRequest
{
    private $orderType = [
        'same_day_delivery',
        'next_day_delivery',
        'document_delivery_service',
        'send_transmitters_service',
        'correspondents_service',
        'packaging_service',
        'governorates_delivery',
        'international_shipping'
    ];
    private $orderStatus = ['phone_from_customer', 'customer_store_in_company'];
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (session('page') == 1) {

            return $this->validateSenderInputs();
        } elseif (session('page') == 2) {

            return $this->validateReciverInputs();
        } else {

            return [

                'order.type'                => ['required', Rule::in($this->orderType)],
                'order.status'              => ['required', Rule::in($this->orderStatus)],
                'order.info'                => ['nullable', 'string', 'max:150'],
                'order.notes'               => ['nullable', 'string', 'max:150'],
                'order.user_can_open_order' => ['required', 'in:1,0'],

                'shipping.weight'                  => ['required', 'string', 'max:6'],
                'shipping.quantity'                => ['required', 'integer'],
                'shipping.price'                   => ['required', 'string', 'max:6'],
                'shipping.charge_price'            => ['required', 'string', 'max:6'],
                'shipping.total_price'             => ['required', 'string', 'max:6'],
                'shipping.charge_on'               => ['required', 'in:sender,reciver'],
                'shipping.total_weight'            => ['required', 'string', 'max:6'],
                'shipping.total_over_weight'       => ['required', 'string', 'max:6'],
                'shipping.total_over_weight_price' => ['required', 'string', 'max:6'],
                'shipping.discount'                => ['nullable', 'string', 'max:6'],

            ];
        }
    }

    private function validateSenderInputs()
    {
        return [
            'sender.fullname'              => 'required|string|max:50',
            'sender.phone'                 => 'required',
            'sender.governorate_id'        => 'required|exists:governorates,id',
            'sender.address'               => 'required|string',
            'sender.special_marque'        => 'required|string|max:100',
            'sender.house_number'          => 'required|string|max:10',
            'sender.door_number'           => 'required|string|max:10',
            'sender.shaka_number'          => 'required|string|max:10',
            'sender.city_id'               => 'required|exists:cities,id',
            'sender.other_phone'           => 'nullable|max:11',
        ];
    }
    private function validateReciverInputs()
    {
        return [
            'reciver.fullname'              => 'required|string|max:50',
            'reciver.phone'                 => 'required',
            'reciver.governorate_id'        => 'required|exists:governorates,id',
            'reciver.address'               => 'required|string',
            'reciver.special_marque'        => 'required|string|max:100',
            'reciver.house_number'          => 'required|string|max:10',
            'reciver.door_number'           => 'required|string|max:10',
            'reciver.shaka_number'          => 'required|string|max:10',
            'reciver.city_id'               => 'required|exists:cities,id',
            'reciver.other_phone'           => 'nullable|max:11',
        ];
    }

    public function attributes()
    {
        return  trans('custom-attributes.order');
    }

    public function validated()
    {
        if ($this->order) {

            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($this->validator->validated()['shipping']);

            $data        = array_merge(
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
