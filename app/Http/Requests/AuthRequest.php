<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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

    public function prepareForValidation()
    {
        if (null === $this->remmber_me){

             $this->merge(['remmber_me' => false ]);
            }else{

            $this->merge(['remmber_me' => true ]);
        }
            
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     =>'required',
            'password' =>'required'
        ];
    }
}
