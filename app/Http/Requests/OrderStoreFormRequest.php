<?php

namespace App\Http\Requests;

use App\Services\CurrentAdminService;
use App\Services\Orders\OrderCountChargePrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class OrderStoreFormRequest extends FormRequest
{

    protected $orderFormRequest;

    public function __construct()
    {
       $this->orderFormRequest = app(CurrentAdminService::class)->orderFormRequest();
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->orderFormRequest->rules();
    }


    public function attributes()
    {
        return  trans('custom-attributes');
    }

    public function validated()
    {
        return $this->orderFormRequest->validated();
    }


}
