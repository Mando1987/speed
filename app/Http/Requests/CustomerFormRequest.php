<?php

namespace App\Http\Requests;

class CustomerFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'customer.fullname' => 'required|string|max:50',
            'customer.phone' => 'required|unique:customers,phone,' . $this->id,
            'customer.other_phone' => 'nullable|max:11|unique:customers,other_phone,' . $this->id,
            'customer.governorate_id' => 'required|exists:governorates,id',
            'customer.city_id' => 'required|exists:cities,id',

            'address.address' => 'required|string',
            'address.special_marque' => 'required|string|max:100',
            'address.house_number' => 'required|string|max:10',
            'address.door_number' => 'required|string|max:10',
            'address.shaka_number' => 'required|string|max:10',
        ];
    }
}
