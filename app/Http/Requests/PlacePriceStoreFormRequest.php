<?php

namespace App\Http\Requests;

class PlacePriceStoreFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'governorate_id' => 'bail|required|exists:governorates,id',
            'city_id' => 'bail|required|exists:cities,id',
            'send_weight' => 'bail|required|in:1,2,3',
            'send_price' => 'bail|required|string|max:7',
            'weight_addtion' => 'bail|required|in:.5,1,2,3',
            'price_addtion' => 'bail|required|string|max:7',
        ];
    }
    public function validated()
    {
        return [
            'checkedDate' => [
                'governorate_id' => $this->governorate_id,
                'city_id' => $this->city_id,
            ],
            'updatedData' => [
                'send_weight' => $this->send_weight,
                'send_price' => $this->send_price,
                'weight_addtion' => $this->weight_addtion,
                'price_addtion' => $this->price_addtion,
            ],

        ];
    }
}
