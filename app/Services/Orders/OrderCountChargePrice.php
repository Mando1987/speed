<?php

namespace App\Services\Orders;

use App\Models\PlacePrice;
use App\Models\Setting;

class OrderCountChargePrice
{
    public $request;
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

    public function getOrderChargePrice($request, $city_id, $validateValues = false)
    {
        $this->city_id = $city_id;
        $this->request = (object) $request;
        $validateValues ? $this->validateValues() : false;
        return $this->countChargePrice();
    }

    private function validateValues()
    {
        $this->request->validate(
            [
                'weight' => ['bail', 'required'],
                'quantity' => ['bail', 'required', 'integer'],
                'price' => ['bail', 'required', 'numeric'],
                'charge_on' => ['bail', 'required', 'in:sender,reciver'],
                'discount' => ['nullable', 'numeric'],
            ],
            [],
            [
                'weight' => trans('site.order_weight'),
                'quantity' => trans('site.order_quantity'),
                'price' => trans('site.order_price'),
                'charge_on' => trans('site.order_charge_on'),
                'discount' => trans('site.order_discount'),
            ]
        );
    }

    private function countChargePrice()
    {
        $this->setPlacePrice();

        $this->total_weight = ceil($this->request->weight * $this->request->quantity);
        $this->total_over_weight = $this->total_weight > $this->chargeprice->send_weight ? $this->total_weight - $this->chargeprice->send_weight : 0;
        $this->total_over_weight_price = ($this->total_over_weight / $this->chargeprice->weight_addtion) * $this->chargeprice->price_addtion;
        $this->discount = $this->request->discount ?? 0;
        $this->charge_price = ($this->total_over_weight_price + $this->chargeprice->send_price) - $this->discount;
        $this->addtion_price = $this->request->charge_on == 'reciver' ? $this->charge_price : 0;
        $this->customer_price = $this->request->charge_on == 'sender' ? $this->request->price - $this->charge_price : $this->request->price;
        $this->total_price = $this->request->price + $this->addtion_price;

        return [
            'weight' => $this->request->weight,
            'quantity' => $this->request->quantity,
            'price' => $this->request->price,
            'discount' => $this->discount,
            'total_weight' => $this->total_weight,
            'total_over_weight' => $this->total_over_weight,
            'total_over_weight_price' => $this->total_over_weight_price,
            'charge_price' => $this->charge_price,
            'total_price' => $this->total_price,
            'charge_on' => $this->request->charge_on,
            'customer_price' => $this->customer_price,
        ];
    }

    private function setPlacePrice()
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

}
