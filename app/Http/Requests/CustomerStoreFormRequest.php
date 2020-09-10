<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {

        $this->merge([

            'is_active'  => $this->get('is_active') ? '1' : '0',
            'type'       => 'customer',

        ]);
    }
    public function rules()
    {
        return [

            'is_active'             => 'nullable',
            'phone'                 => 'required|unique:admins',
            'fullname'              => 'required|string|max:50',
            'user_name'             => 'required|string|unique:admins|max:20',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password',
            'type'                  => 'required|in:manager,customer,mandoob',
            'email'                 => 'required|email|unique:admins',

            'governorate_id'        => 'required|exists:governorates,id',
            'city_id'               => 'required|exists:cities,id',
            'company_name'          => 'nullable|string|max:50',
            'other_phone'           => 'nullable|unique:customers',
            'facebook_page'         => 'nullable|string',
            'notes'                 => 'nullable|string',
            'image'                 => 'nullable|mimes:png,jpg,jpeg|max:500',
            'contract_type'         => 'required|in:daily,monthly',

            'address'               => 'required|string',
            'special_marque'        => 'required|string|max:100',
            'house_number'          => 'required|string|max:10',
            'door_number'           => 'required|string|max:10',
            'shaka_number'          => 'required|string|max:10',
            'activity'              => 'required|string',

        ];
    }



    public function attributes()
    {
        return  trans('custom-attributes.admin');
    }

    public function validated()

    {
        $image = $this->image == '' ? 'default.png' : $this->image;

        $data  =  array_merge($this->validator->validated(), [

            'password' => bcrypt($this->password),
            'image'    => $image,

        ]);
        unset($data['password_confirmation']);

        $customer      = \Arr::only($data, ['governorate_id', 'city_id', 'other_phone', 'facebook_page', 'notes', 'image', 'contract_type']);
        $customerInfos = \Arr::only($data, ['activity', 'special_marque', 'address', 'house_number', 'door_number', 'shaka_number']);

        $admin = \Arr::only($data,[
            'is_active',
            'phone',
            'fullname',
            'user_name',
            'password',
            'type',
            'email',
        ]);
        return  array('admin' => $admin, 'customer' => $customer, 'customerInfos' => $customerInfos);
    }
}
