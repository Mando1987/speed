<?php
namespace App\Http\Traits;

trait OrderTrait
{
    protected $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    private $searchColumns = [
        'recivers.fullname',
        'recivers.phone',
        'shippings.order_num',
        'cities.city_name',
        'cities.city_name_en',
        'customers.fullname',
        'customers.phone',
    ];

    protected $paginate;
    protected $view;
    private $order;
    private $city;
    private $governorate;
    private $address;
    private $cities_id = [];
    private $governorates_id = [];




}
