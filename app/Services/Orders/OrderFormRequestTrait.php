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

}