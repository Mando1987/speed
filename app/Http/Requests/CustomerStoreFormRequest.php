<?php

namespace App\Http\Requests;

class CustomerStoreFormRequest extends FormRequest
{

    protected function prepareForValidation()
    {

        $this->merge([

            'admin' => array_merge(
                $this->get('admin'),
                [
                    'is_active' => isset($this->is_active) ? 1 : 0,
                    'password'  => bcrypt($this->password),
                    'type'      => 'customer',
                ]
            ),
        ]);
    }
    public function rules()
    {
        return [

            'admin.is_active'              => 'nullable',
            'admin.phone'                  => 'required|unique:admins,phone',
            'admin.other_phone'            => 'nullable|unique:admins,other_phone',
            'admin.fullname'               => 'required|string|max:50',
            'admin.user_name'              => 'required|string|unique:admins,user_name|max:20',
            'admin.password'               => 'nullable',
            'admin.type'                   => 'nullable',
            'admin.email'                  => 'required|email|unique:admins,email',
            'password'                     => 'required|confirmed|min:6',
            'password_confirmation'        => 'required|same:password',

            'customer.governorate_id'      => 'required|exists:governorates,id',
            'customer.city_id'             => 'required|exists:cities,id',
            'customer.company_name'        => 'nullable|string|max:50',
            'customer.facebook_page'       => 'nullable|string',
            'customer.activity'            => 'required|string',
            'customer.contract_type'       => 'required|in:daily,monthly',

            'image'                        => 'nullable|mimes:png,jpg,jpeg|max:500',

            'address.address'         => 'required|string',
            'address.special_marque'  => 'required|string|max:100',
            'address.house_number'    => 'required|string|max:10',
            'address.door_number'     => 'required|string|max:10',
            'address.shaka_number'    => 'required|string|max:10',

        ];
    }

    public function validated()
    {
        return array_merge($this->validator->validated(), [
            'image'  =>  $this->image ?? 'default.png',
        ]);
    }
}
