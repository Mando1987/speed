<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacePriceStoreFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'governorate_id'        => 'required|exists:governorates,id',
            'city_id'               => 'required|exists:cities,id',
            'send_weight'           => 'required|in:1,2,3',
            'send_price'            => 'required|string|max:7',
            'weight_addtion'        => 'required|in:.5,1,2,3',
            'price_addtion'         => 'required|string|max:7',
        ];
    }

    public function attributes()
    {
        return  trans('custom-attributes.prices');
    }
}
