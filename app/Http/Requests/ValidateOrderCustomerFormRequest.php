<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ValidateOrderCustomerFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->checkAdminIsManagerOnly();
    }
    public function rules()
    {
        if ($this->customerType == 'new') {
            $validatedData = [
                'customer.fullname' => 'required|string|max:50',
                'customer.phone' => ['required', 'unique:customers,phone'],
                'customer.other_phone' => ['nullable', 'unique:customers,other_phone'],
                'customer.governorate_id' => 'required|exists:governorates,id',
                'customer.city_id' => 'required|exists:cities,id',
                'customerAddress.address' => 'required|string',
                'customerAddress.special_marque' => 'required|string|max:100',
                'customerAddress.house_number' => 'required|string|max:10',
                'customerAddress.door_number' => 'required|string|max:10',
                'customerAddress.shaka_number' => 'required|string|max:10',
                'customerType' => ['required', 'in:new,exists'],
            ];
        } else {
            $validatedData = [
                'customer.id' => ['required', 'exists:customers,id'],
                'customerType' => ['required', 'in:new,exists'],
            ];
        }
        return $validatedData;
    }

    protected function failedValidation(Validator $validator)
    {
        return $this->failedValidationCustom(['target'=> 'validateCustomerError']);
    }


}
