<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Services\CurrentAdminService;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Orders\OrderCountChargePrice;


class OrderStoreFormRequest extends FormRequest
{

    protected $orderFormRequest;
    private $type;
    private $identifyOrdersFetch;
    public function __construct()
    {
        $identify      = auth('admin')->user();
        $this->type    = $identify->type;
        $type          = $this->type;
        $className     = __CLASS__ .'By'.Str::ucfirst($type);
        $this->identifyOrdersFetch = (new $className);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->identifyOrdersFetch->rules();
    }


    public function attributes()
    {
        return  trans('custom-attributes');
    }

    public function validated()
    {
        return $this->identifyOrdersFetch->validated($this->order, $this->validator->validated());
    }


}
