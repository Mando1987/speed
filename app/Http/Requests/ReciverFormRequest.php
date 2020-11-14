<?php

namespace App\Http\Requests;

class ReciverFormRequest extends FormRequest
{
    public function rules()
    {

        return [
            'reciver.fullname' => 'required|string|max:50',
            'reciver.phone' => 'required|unique:recivers,phone,' . $this->id,
            'reciver.other_phone' => 'nullable|max:11|unique:recivers,other_phone,' . $this->id,
            'reciver.governorate_id' => 'required|exists:governorates,id',
            'reciver.city_id' => 'required|exists:cities,id',

            'address.address' => 'required|string',
            'address.special_marque' => 'required|string|max:100',
            'address.house_number' => 'required|string|max:10',
            'address.door_number' => 'required|string|max:10',
            'address.shaka_number' => 'required|string|max:10',
        ];
    }
}
