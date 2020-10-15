<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PlaceUpdateFormRequest extends FormRequest
{

    private $customRules = [];
    private $customAttributes = [];
    private $customAttributesNames = [];

    public function authorize()
    {
        // admin is manager ??  abort(404)
        return $this->checkAdminIsManagerOnly();
    }

    public function rules()
    {
        $this->customAttributesNames = trans('custom-attributes')['cities'];
        // loop for rules to get unique cities by name
        foreach ($this->cities as $city_id => $columns) {
            foreach ($columns as $key => $value) {
                $arrayKey = "cities.{$city_id}.{$key}";
                $this->customRules[$arrayKey] = ['required', 'string', Rule::unique('cities', $key)->ignore($city_id, 'id')];
                $this->customAttributes[$arrayKey] = $this->customAttributesNames[$key];
            }
        }
        $this->customRules['governorate_id'] = ['required', 'exists:governorates,id'];
        return $this->customRules;

    }

    public function attributes()
    {
        return $this->customAttributes;
    }
}
