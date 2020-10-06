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
    protected $orderStatus = ['under_review', 'under_preparation'];

    protected function validateReciverInputs()
    {
        return [
            'reciver.fullname'              => 'required|string|max:50',
            'reciver.phone'                 => 'required|unique:recivers,phone',
            'reciver.other_phone'           => 'nullable|max:11|unique:recivers,other_phone',
            'reciver.governorate_id'        => 'required|exists:governorates,id',
            'reciver.city_id'               => 'required|exists:cities,id',

            'address.address'               => 'required|string',
            'address.special_marque'        => 'required|string|max:100',
            'address.house_number'          => 'required|string|max:10',
            'address.door_number'           => 'required|string|max:10',
            'address.shaka_number'          => 'required|string|max:10',
        ];
    }
}