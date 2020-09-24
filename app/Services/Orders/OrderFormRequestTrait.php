<?php
namespace App\Services\Orders;

trait OrderFormRequestTrait
{
    protected $orderType = [
        'same_day_delivery',
        'next_day_delivery',
        'document_delivery_service',
        'send_transmitters_service',
        'correspondents_service',
        'packaging_service',
        'governorates_delivery',
        'international_shipping'
    ];
    protected $orderStatus = ['phone_from_customer', 'customer_store_in_company'];

    protected function validateReciverInputs()
    {
        return [
            'reciver.fullname'              => 'required|string|max:50',
            'reciver.phone'                 => 'required|unique:recivers,phone',
            'reciver.governorate_id'        => 'required|exists:governorates,id',
            'reciver.address'               => 'required|string',
            'reciver.special_marque'        => 'required|string|max:100',
            'reciver.house_number'          => 'required|string|max:10',
            'reciver.door_number'           => 'required|string|max:10',
            'reciver.shaka_number'          => 'required|string|max:10',
            'reciver.city_id'               => 'required|exists:cities,id',
            'reciver.other_phone'           => 'nullable|max:11|unique:recivers,other_phone',
        ];
    }
}