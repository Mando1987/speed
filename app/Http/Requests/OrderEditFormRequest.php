<?php

namespace App\Http\Requests;

use App\Models\Reciver;
use Illuminate\Validation\Rule;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrderFormRequestTrait;

class OrderEditFormRequest extends FormRequest
{
    use OrderFormRequestTrait;
    public function authorize()
    {
        return !$this->adminIsDelegate;
    }

    public function rules()
    {
        return [
            'order.type' => ['required', Rule::in($this->orderType)],
            'order.status' => ['required', Rule::in($this->orderStatus)],
            'order.info' => ['required', 'string', 'max:150'],
            'order.notes' => ['nullable', 'string', 'max:150'],
            'order.user_can_open_order' => ['required', 'in:1,0'],

            'shipping.weight' => ['required', 'string', 'max:6'],
            'shipping.quantity' => ['required', 'integer'],
            'shipping.price' => ['required', 'string', 'max:6'],
            'shipping.charge_price' => ['required', 'string', 'max:6'],
            'shipping.total_price' => ['required', 'string', 'max:6'],
            'shipping.charge_on' => ['required', 'in:sender,reciver'],
            'shipping.total_weight' => ['required', 'string', 'max:6'],
            'shipping.total_over_weight' => ['required', 'string', 'max:6'],
            'shipping.total_over_weight_price' => ['required', 'string', 'max:6'],
            'shipping.discount' => ['nullable', 'string', 'max:6'],
        ];
    }
    public function validated()
    {
        if (session('reciver')['existingId']){
            $city_id = Reciver::find(session('reciver')['existingId'])->city_id;
         }else{
             $city_id = session('reciver')['city_id'];
         }
        $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($this->validator->validated()['shipping'] , $city_id);
        $data = array_merge(
            $this->validator->validated(),
            [
                'shipping' => $ChargePrice,
            ]
        );
        return $data;
    }
}
