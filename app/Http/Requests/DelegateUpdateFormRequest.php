<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;


class DelegateUpdateFormRequest extends FormRequest
{
    private $status = ['single', 'married', 'divorce', 'widower'];
    private $driveType = ['motocycle', 'car', 'trocycle'];

    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
       $this->merge([
            'admin' => ['is_active' => isset($this->is_active) ? 1 : 0]
        ]);
    }

    public function rules()
    {
        return [
            'is_active' => 'nullable',

            'delegate.fullname'          => 'required|string|max:50',
            'delegate.qualification'     => 'required|string|max:50',
            'delegate.national_id'       => 'required|string|min:14|max:14|unique:delegates,national_id,'.$this->id,
            'delegate.social_status'     => ['required', Rule::in($this->status)],
            'delegate.governorate_id'    => 'required|exists:governorates,id',
            'delegate.city_id'           => 'required|exists:cities,id',
            'delegate.address'           => 'required|string',

            'delegateDrive.type'         => ['required', Rule::in($this->driveType)],
            'delegateDrive.color'        => 'required|string|max:20',
            'delegateDrive.plate_number' => 'required|string|max:20|unique:delegate_drives,plate_number,'.$this->delegateDriveId,
            'image'                      => 'nullable|mimes:png,jpg,jpeg|max:500',
            'national_image'             => 'nullable|mimes:png,jpg,jpeg|max:500',
        ];
    }

    public function validated()
    {
        $delegateDrive = $this->validator->validated()['delegateDrive'];
        return [
            'delegate' => $this->validator->validated()['delegate'],
            'delegateDrive' => $delegateDrive,
            'admin' => $this->admin,
            'image' => $this->image ?? 'default.png',
            'national_image' => $this->national_image ?? 'default.png',
        ];
    }
}
