<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class DelegateStoreFormRequest extends FormRequest
{
    private $status = ['single', 'married', 'divorce', 'widower'];
    private $driveType = ['motocycle', 'car', 'trocycle'];

    public function prepareForValidation()
    {
        $this->merge([

            'admin' => array_merge(
                $this->get('admin'),
                [
                    'is_active' => isset($this->is_active) ? 1 : 0,
                    'password'  => bcrypt($this->password),
                    'type'      => 'delegate',
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

            'delegate.fullname' => 'required|string|max:50|unique:delegates,fullname',
            'delegate.qualification' => 'required|string|max:50',
            'delegate.national_id' => 'required|string|unique:delegates,national_id|min:14|max:14',
            'delegate.social_status' => ['required', Rule::in($this->status)],
            'delegate.governorate_id' => 'required|exists:governorates,id',
            'delegate.city_id' => 'required|exists:cities,id',
            'delegate.address' => 'required|string',

            'delegateDrive.type' => ['required', Rule::in($this->driveType)],
            'delegateDrive.color' => 'required|string|max:20',
            'delegateDrive.plate_number' => 'required|string|unique:delegate_drives,plate_number|max:20',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:500',
            'national_image' => 'nullable|mimes:png,jpg,jpeg|max:500',
        ];
    }

    public function validated()
    {
        $admin = $this->validator->validated()['admin'];
        $delegateDrive = $this->validator->validated()['delegateDrive'];
        $delegate = array_merge($this->validator->validated()['delegate'], $admin);
        return [
            'delegate' => $delegate,
            'delegateDrive' => $delegateDrive,
            'admin' => $admin,
            'image' => $this->image ?? 'default.png',
            'national_image' => $this->national_image ?? 'default.png',
        ];
    }
}
