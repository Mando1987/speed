<?php

namespace App\Http\Requests;

class PlacePriceEditFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'send_weight' => 'required|in:1,2,3',
            'send_price' => 'required|string|max:7',
            'weight_addtion' => 'required|in:.5,1,2,3',
            'price_addtion' => 'required|string|max:7',
        ];
    }
}
