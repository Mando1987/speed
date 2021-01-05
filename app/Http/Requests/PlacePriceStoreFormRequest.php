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
}
