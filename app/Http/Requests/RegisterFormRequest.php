<?php

namespace App\Http\Requests;

class RegisterFormRequest extends FormRequest
{

    public function rules()
    {
        return [

            'phone'                  => 'required|unique:admins,phone|max:11',
            'fullname'               => 'required|string|max:50',
            'admin.email'                  => 'required|email|unique:admins,email',
            'admin.user_name'              => 'required|string|unique:admins,user_name',

            'password'                     => 'required|confirmed|min:6',
            'password_confirmation'        => 'required|same:password',

            'customer.governorate_id'      => 'required|exists:governorates,id',
            'customer.city_id'             => 'required|exists:cities,id',

            'address.address'         => 'required|string',

        ];
    }

    public function validated()
    {
        $data['admin'] = array_merge(
            $this->admin,
            [
                'is_active' => 1,
                'password'  => bcrypt($this->password),
                'type'      => 'customer',
                'phone'  => $this->phone,
                'fullname'  => $this->fullname,
            ]
        );
        $data['customer'] = array_merge(
            $this->validator->validated()['customer'],
            [
                'phone'  => $this->phone,
                'fullname'  => $this->fullname,
            ]
        );
        $data['address'] = $this->address;

        return $data;

    }
}
