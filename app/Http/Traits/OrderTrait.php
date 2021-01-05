<?php
namespace App\Http\Traits;

use App\Models\Address;
use App\Models\City;
use App\Models\Governorate;

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
    private $order;
    private $city;
    private $governorate;
    private $address;
    private $cities_id = [];
    private $governorates_id = [];

    private function setAddressRelationship($model, $relation): void
    {
        $relations = ['reciver' => 'App\\Models\\Reciver', 'customer' => 'App\\Models\\Customer'];
        $this->address = $this->address ?? Address::get();

        $this->address->map(function ($address) use ($model, $relation, $relations) {
            if ($address->addressable_type == $relations[$relation] && $address->addressable_id == $model->$relation->id) {
                $model->$relation->address = $address;
            }
        });
    }

    private function setCityRelationship($model, $relation): void
    {
        $this->city = $this->city ?? City::whereIn('id', $this->cities_id)->get();
        $this->city->map(function ($city) use ($model, $relation) {
            if ($city->id == $model->$relation->city_id) {
                return $model->$relation->city = $city;
            }
        });
    }
    private function setGovernorateRelationship($model, $relation): void
    {
        $this->governorate = $this->governorate ?? Governorate::whereIn('id', $this->governorates_id)->get();
        $this->governorate->map(function ($governorate) use ($model, $relation) {
            if ($governorate->id == $model->$relation->governorate_id) {
                return $model->$relation->governorate = $governorate;
            }
        });
    }

    private function setOrderRelationship($orderData, $realtionName): void
    {
        $this->cities_id[] = $orderData->$realtionName->city_id;
        $this->governorates_id[] = $orderData->$realtionName->governorate_id;
        $this->setCityRelationship($orderData, $realtionName);
        $this->setAddressRelationship($orderData, $realtionName);
        $this->setGovernorateRelationship($orderData, $realtionName);
    }

}
