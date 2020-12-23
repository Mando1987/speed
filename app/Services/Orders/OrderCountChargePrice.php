<?php

namespace App\Services\Orders;

use App\Models\Setting;
use App\Models\PlacePrice;
use Illuminate\Http\Request;

class OrderCountChargePrice
{
    private $request;
    private $shipping;
    private $chargeprice;
    private $city_id;

    public $discount;
    public $total_weight;
    public $total_over_weight;
    public $total_over_weight_price;
    public $addtion_price;
    public $charge_price;
    public $total_price;
    public $charge_on;
    public $customer_price;
    /**
     * to calculate order charge price and total price
     *
     * @param Request $request
     * @param boolean $validateValues
     * @return array
     */
    public function getOrderChargePrice(Request $request,bool $validateValues = false) :array
    {
        $this->request = $request;
        $this->city_id = $request->reciver_city_id;
        $this->shipping = $request->shipping;
        $validateValues ? $this->validateValues() : false;
        return $this->countChargePrice();
    }

    private function validateValues()
    {
        $this->request->validate(
            [
                'shipping.weight' => ['bail', 'required'],
                'shipping.quantity' => ['bail', 'required', 'integer'],
                'shipping.price' => ['bail', 'required', 'numeric'],
                'shipping.charge_on' => ['bail', 'required', 'in:sender,reciver'],
                'shipping.discount' => ['nullable', 'numeric'],
            ],
            [],
            [
                'shipping.weight' => trans('site.order_weight'),
                'shipping.quantity' => trans('site.order_quantity'),
                'shipping.price' => trans('site.order_price'),
                'shipping.charge_on' => trans('site.order_charge_on'),
                'shipping.discount' => trans('site.order_discount'),
            ]
        );
    }

    private function countChargePrice() :array
    {
        $this->setPlacePrice();
        $this->setTotalWeight();
        $this->setTotalOVerWeight();
        $this->setTotalOVerWeightPrice();
        $this->setDiscount();
        $this->setChargePrice();
        $this->setCustomerPrice();
        $this->setTotlaPrice();

        return $this->getShippingData();
    }

    private function setPlacePrice() :void
    {
        $charge_price = PlacePrice::where(function ($query) {
            $query->where('city_id', $this->city_id);
        })->first();
        if ($charge_price) {
            $this->chargeprice = $charge_price;
        } else {
            $default_price = Setting::where('event', 'default_charge_price')->first();
            $this->chargeprice = $default_price->data;
        }
        return $this->chargeprice;
    }

    private function setTotalWeight()
    {
       $this->total_weight = ceil($this->shipping['weight'] * $this->shipping['quantity']);
    }
    private function setTotalOverWeight() :void
    {
        $this->total_over_weight = $this->total_weight > $this->chargeprice->send_weight ?
                                      $this->total_weight - $this->chargeprice->send_weight : 0;
    }

    private function setTotalOverWeightPrice()
    {
        $this->total_over_weight_price = ($this->total_over_weight / $this->chargeprice->weight_addtion) * $this->chargeprice->price_addtion;
    }

    private function setChargePrice()
    {
        $this->charge_price = ($this->total_over_weight_price + $this->chargeprice->send_price) - $this->discount;
    }
    private function setAddtionPrice()
    {
        return $this->checkIfChargeOnReciver() ? $this->charge_price : 0;
    }
    private function setCustomerPrice()
    {
        $this->customer_price = !$this->checkIfChargeOnReciver() ? $this->shipping['price'] - $this->charge_price : $this->shipping['price'];
    }

    public function setTotlaPrice()
    {
        $this->total_price =  $this->shipping['price'] + $this->setAddtionPrice();
    }


    private function checkIfChargeOnReciver() :bool
    {
        return $this->shipping['charge_on'] == 'reciver' ? true:false;
    }

    private function setDiscount()
    {
        $this->discount =  $this->shipping['discount'] ?? 0;
    }

    private function getShippingData() : array
    {
        return   [
            'total_weight' => $this->total_weight,
            'total_over_weight' => $this->total_over_weight,
            'total_over_weight_price' => $this->total_over_weight_price,
            'charge_price' => $this->charge_price,
            'customer_price' => $this->customer_price,
            'total_price' => $this->total_price,
            'discount' => $this->discount,
        ];
    }









}
