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

        $this->merge([

            'admin' => array_merge(
                $this->get('admin'),
                [
                    'is_active' => 1,
                    'password'  => bcrypt($this->password),
                    'type'      => 'customer',
                    'email'     => session('facebook')['email'],
                    'fullname'  => session('facebook')['fullname'],
                ]
            ),
            'customer' => array_merge(
                $this->get('customer'),
                [
                    'image'     => session('facebook')['image'],
                ]
            ),
        ]);
    }
    public function rules()
    {
        return [

            'admin.phone'                  => 'required|unique:admins,phone|max:11',
            'admin.fullname'               => 'required|string|max:50',
            'admin.email'                  => 'required|email|unique:admins,email',

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
        $data['admin'] = array_merge(
            $this->validator->validated()['admin'],
            [
                'is_active' => 1,
                'password'  => bcrypt($this->password),
                'type'      => 'customer',
                'email'     => session('facebook')['email'],
                'fullname'  => session('facebook')['fullname']
            ]
        );
        $data['customer'] = array_merge(
            $this->validator->validated()['customer'],
            [
                'image'  => session('facebook')['image']
            ]
        );
        $data['customerInfo'] = $this->customerInfo;

        return $data;

    }
}
