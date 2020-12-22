<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

class ValidateOrderReciverFormRequest extends FormRequest
{

    public function authorize()
    {
        return !$this->adminIsDelegate;
    }
    public function rules()
    {
        if ($this->reciverType == 'new') {
            $validatedData = [
                'reciver.fullname' => 'required|string|max:50',
                'reciver.phone' => 'required|unique:recivers,phone',
                'reciver.other_phone' => 'nullable|unique:recivers,other_phone',
                'reciver.governorate_id' => 'required|exists:governorates,id',
                'reciver.city_id' => 'required|exists:cities,id',

                'reciverAddress.address' => 'required|string',
                'reciverAddress.special_marque' => 'required|string|max:100',
                'reciverAddress.house_number' => 'required|string|max:10',
                'reciverAddress.door_number' => 'required|string|max:10',
                'reciverAddress.shaka_number' => 'required|string|max:10',
                'reciverType' => ['required', 'in:new,exists'],
            ];
        } else {
            $validatedData = [
                'reciver.id' => ['required', 'exists:recivers,id'],
                'reciverType' => ['required', 'in:new,exists'],
            ];
        }
        return $validatedData;
    }
    protected function failedValidation(Validator $validator)
    {
        $data = ['target' => 'validateReciverErrorNew'];
        if ($this->reciverType == 'exists') {
            $data = ['target' => 'validateReciverErrorExists', 'alert' => [
                'title' => '',
                'icon' => 'warning',
                'html' => view('includes.alerts.no-recivers')->toHtml(),
            ]];
        }
        return $this->failedValidationCustom($data);
    }
}
