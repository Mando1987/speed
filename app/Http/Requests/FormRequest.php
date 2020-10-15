<?php

namespace App\Http\Requests;

use App\Http\Traits\IdentifyTrait;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    use IdentifyTrait;

    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return  trans('custom-attributes');
    }

    public function checkAdminIsManagerOnly()
    {
        return $this->adminType == 'manager' ? true: abort(404);
    }

}
