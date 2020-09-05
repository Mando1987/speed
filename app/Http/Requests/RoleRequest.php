<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    protected function prepareForValidation()
    {
        $this->merge([
            
            'type' => currentAdminType(),
        ]);
    }
    
    public function rules()
    {
        return [
            'name'        => 'required|unique:roles',
            'permissions' => 'required|array|min:1',
            'type'        => 'required',
        ];
    }

    
    public function attributes()
    {
       return  trans('custom-attributes.role');
        
    }
}
