<?php

namespace App\Http\Requests;

class PlaceStoreFormRequest extends FormRequest
{

    public function authorize()
    {
        return $this->checkAdminIsManagerOnly();
    }

    public function rules()
    {
        return [
            'governorate_id' => 'required|exists:governorates,id',
            'cities.*.city_name' => ['required', 'string', 'distinct', 'unique:cities,city_name'],
            'cities.*.city_name_en' => ['required', 'string', 'distinct', 'unique:cities,city_name_en'],
        ];
    }

    public function validated()
    {

        $citiesFinal = [];
        foreach ($this->validator->validated()['cities'] as $key => $city) {
            $citiesFinal[] = array_merge($city, ['governorate_id' => $this->governorate_id]);
        }
        return ['cities' => $citiesFinal];

    }
}
