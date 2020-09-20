<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerSouqFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'sellersouq.*.order_num'      => ['required', 'distinct'],
            'sellersouq.*.order_info'     => ['required', 'string'],
            'sellersouq.*.order_quantity' => ['required' , 'integer'],
            'sellersouq.*.order_weight'   => ['required'],
        ];
    }
    public function attributes()
    {
        return  trans('custom-attributes');
    }
}
