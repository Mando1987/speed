<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Http\FormRequest;

class AdminStoreFormRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
       
        $this->merge([
            
            'type'         => currentAdminType(),
            'is_active'    => $this->get('is_active')? '1' : '0' , 
            'parent_id'    => auth('admin')->id(), 

        ]);
    }
    public function rules()
    {
        return [
    
            'is_active'             => 'nullable',
            'fullname'              => 'required|string|max:50',
            'name'                  => 'required|string|unique:admins|max:20',
            'role_id'               => 'required|numeric|exists:roles,id',
            'parent_id'             => 'nullable',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password',
            'image'                 => 'mimes:png,jpg,jpeg|max:500',
            'type'                  => 'nullable',
            'email'                 => 'sometimes|email',
            'address'               => 'required',
            'phone'                 => 'required|unique:profiles',
            // 'company_id'            => 'required',
            
         ];
    }
    
    

    public function attributes()
    {
       return  trans('custom-attributes.admin');
        
    }

    public function validated()

    {
      $image = $this->image == '' ? 'default.png' : $this->image;

      $data  =  array_merge($this->validator->validated(),[

        'password' => bcrypt($this->password) , 
        'image'    => $image,
        
      ]);
      unset($data['password_confirmation']);

      $profile = Arr::only($data , ['email' , 'phone' , 'address']);

      [$keys]  = Arr::divide($profile);

      $admin   =  Arr::except($data , $keys);

      return  array('admin' =>$admin , 'profile' => $profile);

    }
}
