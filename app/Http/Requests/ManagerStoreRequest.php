<?php

namespace App\Http\Requests;

class ManagerStoreRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([

            'admin' => array_merge(
                $this->get('admin'),
                [
                    'is_active' => isset($this->is_active) ? 1 : 0,
                    'password'  => bcrypt($this->password),
                    'type'      => 'manager',
                ]
            ),
        ]);
    }

    public function rules()
    {
        return [
            'admin.phone' => 'required|unique:admins,phone|max:11',
            'admin.other_phone' => 'nullable|unique:admins,other_phone|max:11',
            'admin.user_name' => 'required|string|unique:admins,user_name|max:20',
            'admin.email' => 'required|email|unique:admins,email',
            'admin.password' => 'nullable',
            'admin.type' => 'nullable',
            'password' => 'required|confirmed|min:6',
             'password_confirmation' => 'required|same:password',
            'is_active' => 'nullable',

            'manager.fullname' => 'required|string|max:50|unique:managers,fullname',
        ];
    }
    public function validated()
    {
        return [
            'manager' => $this->validator->validated()['manager'],
            'admin' => $this->validator->validated()['admin'],
        ];
    }
}
