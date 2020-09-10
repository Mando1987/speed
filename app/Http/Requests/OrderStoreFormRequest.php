<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreFormRequest extends FormRequest
{
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

                // "order_type_id"      => "1" ,
                "order.order_info"         => 'required|string|max:150',
                "order.order_weight"       => 'required|numeric',
                "order.order_quantity"     => 'required|integer',
                "order.order_price"        => 'required|numeric',
                "order.order_charge_price" => 'required|numeric',
                "order.order_total_price"  => 'required|numeric',
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
}
