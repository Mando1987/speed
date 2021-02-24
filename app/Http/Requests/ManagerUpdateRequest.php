<?php

namespace App\Http\Requests;

class ManagerUpdateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([

            'admin' => array_merge(
                $this->get('admin'),
                [
                    'is_active' => isset($this->is_active) ? 1 : 0,
                    'type' => 'manager',
                ]
            ),
        ]);
    }

    public function rules()
    {
        return [
            'admin.phone' => 'required|max:11|unique:admins,phone,' . $this->adminId,
            'admin.other_phone' => 'nullable|max:11|unique:admins,other_phone,' . $this->adminId,
            'admin.user_name' => 'required|string|max:20||unique:admins,user_name,' . $this->adminId,
            'admin.email' => 'required|email|unique:admins,email,' . $this->adminId,
            'admin.type' => 'nullable',
            'is_active' => 'nullable',

            'manager.fullname' => 'required|string|max:50|unique:managers,fullname,' . $this->managerId,
        ];
    }
    public function validated()
    {
        return [
            'manager' => $this->validator->validated()['manager'],
            'admin' => $this->validator->validated()['admin'],
            'managerId' => $this->managerId,
            'adminId' => $this->adminId
        ];
    }
}
