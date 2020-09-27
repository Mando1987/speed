<?php

namespace App\Services\Orders;

use App\Models\PlacePrice;

class OrderCountChargePrice
{
    public $request;
    private $reciver;
    private $chargeprice;

    public  $discount;
    public  $total_weight;
    public  $total_over_weight;
    public  $total_over_weight_price;
    public  $addtion_price;
    public  $charge_price;
    public  $total_price;
    public  $charge_on;
    public  $customer_price;


    public function getOrderChargePrice($request, $validation = false)
    {
        $this->reciver = session('reciver');
        $this->request = (object) $request;
        $validation ? $this->Validation() : false;

        return  $this->checkPlacePriceExists() ? $this->countChargePrice() : $this->showAddPlacePrice();
    }

    private function Validation()
    {
        $this->request->validate(
            [
                'weight'    => ['bail', 'required'],
                'quantity'  => ['bail', 'required', 'integer'],
                'price'     => ['bail', 'required', 'numeric'],
                'charge_on' => ['bail', 'required', 'in:sender,reciver'],
                'discount'  => ['nullable', 'numeric'],
            ],
            [],
            [
                'weight'    => trans('site.order_weight'),
                'quantity'  => trans('site.order_quantity'),
                'price'     => trans('site.order_price'),
                'charge_on' => trans('site.order_charge_on'),
                'discount'  => trans('site.order_discount'),
            ]
        );
    }

    private function countChargePrice()
    {
        $this->total_weight            = ceil($this->request->weight * $this->request->quantity);
        $this->total_over_weight       = $this->total_weight - $this->chargeprice->send_weight;
        $this->total_over_weight_price = ($this->total_over_weight / $this->chargeprice->weight_addtion) * $this->chargeprice->price_addtion;
        $this->discount                = $this->request->discount ?? 0;
        $this->charge_price            = ($this->total_over_weight_price + $this->chargeprice->send_price) - $this->discount;

        $this->addtion_price           = $this->request->charge_on == 'reciver' ?  $this->charge_price : 0;

        $this->customer_price          = $this->request->charge_on == 'sender' ?  $this->request->price - $this->charge_price : $this->request->price;
        $this->total_price             = $this->request->price +  $this->addtion_price;

        return [
            'weight'                   => $this->request->weight,
            'quantity'                 => $this->request->quantity,
            'price'                    => $this->request->price,
            'discount'                 => $this->discount,
            'total_weight'             => $this->total_weight,
            'total_over_weight'        => $this->total_over_weight,
            'total_over_weight_price'  => $this->total_over_weight_price,
            'charge_price'             => $this->charge_price,
            'total_price'              => $this->total_price,
            'charge_on'                => $this->request->charge_on,
            'customer_price'           => $this->customer_price
        ];
    }

    private function checkPlacePriceExists()
    {
        return $this->chargeprice = PlacePrice::where(function ($query) {
            $query->where('governorate_id', $this->reciver['governorate_id'])
                ->where('city_id', $this->reciver['city_id']);
        })->first();
    }

    private function showAddPlacePrice()
    {
        return response()->json([
            'showModelAddPlacePrice' => true,
            'title'                  => trans('site.place_price_not_found'),
            'cancelButtonText'       => trans('site.cancel'),
            'confirmButtonText'      => trans('site.add'),
            'url'                    => '/price/create',
        ]);
    }
}
