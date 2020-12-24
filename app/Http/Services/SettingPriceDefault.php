<?php
namespace App\Http\Services;

class SettingPriceDefault
{
    public float $send_weight;
    public float $send_price;
    public float $weight_addtion;
    public float $price_addtion;

    /**
     *
     * @param float $send_weight
     * @param float $send_price
     * @param float $weight_addtion
     * @param float $price_addtion
     */
    public function __construct(float $send_weight, float $send_price, float $weight_addtion, float $price_addtion)
    {
        $this->send_weight = $send_weight;
        $this->send_price = $send_price;
        $this->weight_addtion = $weight_addtion;
        $this->price_addtion = $price_addtion;
    }
}
