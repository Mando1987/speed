<?php
namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Services\Orders\OrderCountChargePrice;
use Illuminate\Contracts\Validation\Validator;

class OrderStoreFormRequest extends FormRequest
{
    protected $orderType = [
        'same_day_delivery',
        'next_day_delivery',
        'document_delivery_service',
        'send_transmitters_service',
        'correspondents_service',
        'packaging_service',
        'governorates_delivery',
        'international_shipping',
    ];
    public function authorize()
    {
        return !$this->adminIsDelegate;
    }
    public function prepareForValidation()
    {
        $this->merge(
           [ 'reciver_city_id' => session('orderData')['reciver_city_id']]
        );
    }

    public function rules()
    {
        return [
            'order.type' => ['required', Rule::in($this->orderType)],
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
            'reciver_city_id' => ['nullable', 'exists:cities,id'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        return $this->failedValidationCustom(
            [
                'target' => 'validateOrderError',
                'alert' => [
                    'title' => '',
                    'icon' => 'warning',
                    'html' => view('includes.alerts.no-recivers')->toHtml(),
                ],
            ]);
    }
    public function validated()
    {
        /**
         * calculate order charge price
         * return array
        */
        if (session('orderData')['page'] == 'order') {
            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($this);
            $data = array_merge(
                $this->validator->validated(),
                [
                    'shipping' => array_merge($this->shipping, $ChargePrice),
                    'reciver' => session('orderData')['reciver'],
                ]
            );
            if ($this->adminIsManager) {
                $data = array_merge($data, ['customer' => session('orderData')['customer']]);
            }
            unset($data['reciver_city_id']);
            return $data;
        }
        return $this->validator->validated();
    }

}
