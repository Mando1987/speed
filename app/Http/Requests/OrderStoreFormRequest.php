<?php

namespace App\Http\Requests;

class OrderStoreFormRequest extends FormRequest
{

    public function rules()
    {
        return $this->identify($this)->rules();
    }

    public function validated()
    {
        return $this->identify($this)->validated($this->order, $this->validator->validated());
    }


}
