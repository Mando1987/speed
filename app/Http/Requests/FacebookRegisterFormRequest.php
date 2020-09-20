<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacebookRegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {

        // $this->merge([

        //     'admin' => array_merge(
        //         $this->get('admin'),
        //         [
        //             'is_active' => 1,
        //             'password'  => bcrypt($this->password),
        //             'type'      => 'customer',
        //         ]
        //     ),
        // ]);
    }
    public function rules()
    {
        return [

            'admin.phone'                  => 'required|unique:admins,phone',
            'admin.user_name'              => 'required|string|unique:admins,user_name|max:20',

            'password'                     => 'required|confirmed|min:6',
            'password_confirmation'        => 'required|same:password',

            'customer.governorate_id'      => 'required|exists:governorates,id',
            'customer.city_id'             => 'required|exists:cities,id',

            'customerInfo.address'         => 'required|string',

        ];
    }



    public function attributes()
    {
        return  trans('custom-attributes');
    }

    public function validated()
    {

        return array_merge($this->validator->validated(), [
            'image'  =>  $this->image ?? 'default.png',
        ]);

    }
}
