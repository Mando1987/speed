<?php
namespace App\Http\Requests;

use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Services\Orders\OrderCountChargePrice;
use App\Services\Orders\OrderFormRequestTrait;
use Illuminate\Validation\Rule;

class OrderStoreFormRequestRepository extends FormRequest implements OrderStoreFormRequestInterface
{
    use OrderFormRequestTrait;

    public function authorize()
    {
        return !$this->adminIsDelegate;
    }

    public function prepareForValidation()
    {
        if($this->adminType == 'customer' && $this->order){
            $this->merge(['order' => array_merge($this->order, ['status' => 'under_review'])]);
        }
    }
    public function rules()
    {

        if ($this->adminType == 'manager') {

            if (session('page') == 1) {
                session(['chooseType' => ($this->customer_id =="")?'new': $this->chooseType]);

                if ($this->chooseType == 'new') {
                    return $this->validateSenderInputs();
                } else {
                    return [
                        'customer_id' => ['required', 'exists:customers,id'],
                        'chooseType' => ['required', 'in:new,exists'],
                    ];
                }
            } elseif (session('page') == 2) {
                session(['chooseType' => ($this->reciver_id =="")?'new': $this->chooseType]);
                if ($this->chooseType == 'new') {
                    return $this->validateReciverInputs();
                } else {
                    return [
                        'reciver_id' => ['required', 'exists:recivers,id'],
                        'chooseType' => ['required', 'in:new,exists'],
                    ];
                }

            } else {
                return $this->orderAttributes();
            }

        }else{

            if (session('page') == 1) {

                session(['chooseType' => ($this->reciver_id =="")?'new': $this->chooseType]);

                if ($this->chooseType == 'new') {
                    return $this->validateReciverInputs();
                } else {
                    return [
                        'reciver_id' => ['required', 'exists:recivers,id'],
                        'chooseType' => ['required', 'in:new,exists'],
                    ];
                }

            } else {
                return $this->orderAttributes();
            }
        }
    }

    private function validateSenderInputs()
    {
        return [
            'customer.fullname' => 'required|string|max:50',
            'customer.phone' => ['required', 'unique:customers,phone'],
            'customer.other_phone' => ['nullable', 'max:11', 'unique:customers,other_phone'],
            'customer.governorate_id' => 'required|exists:governorates,id',
            'customer.city_id' => 'required|exists:cities,id',

            'address.address' => 'required|string',
            'address.special_marque' => 'required|string|max:100',
            'address.house_number' => 'required|string|max:10',
            'address.door_number' => 'required|string|max:10',
            'address.shaka_number' => 'required|string|max:10',
        ];
    }

    public function validated()
    {
        if($this->adminType == 'manager'){

            if (session('page') == 1 &&  $this->chooseType =='exists') {
                return [
                    'customer' => [
                        'chooseType' => $this->chooseType,
                        'existingId' => $this->customer_id,
                    ],
                ];
            }elseif(session('page') == 2 &&  $this->chooseType =='exists'){
                return [
                    'reciver' => [
                        'chooseType' => $this->chooseType,
                        'existingId' => $this->reciver_id,
                    ],
                ];
            }
        }else{
            if(session('page') == 1 &&  $this->chooseType =='exists'){
                return [
                    'reciver' => [
                        'chooseType' => $this->chooseType,
                        'existingId' => $this->reciver_id,
                    ],
                ];
            }
        }
        if ($this->order) {

            $ChargePrice = app(OrderCountChargePrice::class)->getOrderChargePrice($this->validator->validated()['shipping']);

            $data = array_merge(
                $this->validator->validated(),
                [
                    'shipping' =>  $ChargePrice,
                    'customer' => session('customer'),
                    'customerAddress' => session('customerAddress'),
                    'reciver' => session('reciver'),
                    'reciverAddress' => session('reciverAddress'),
                ]
            );
            return $data;
        }
        return $this->validator->validated();
    }

    public function orderAttributes()
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
}
