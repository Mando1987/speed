<?php
namespace App\Http\Traits;

use App\Models\Address;

trait AddressMorph
{
    public function address()
    {
        return $this->morphOne(Address::class , 'addressable')->withDefault(
            [
                'address' => trans('site.nothing'),
                'special_marque' => trans('site.nothing'),
                'house_number' => trans('site.nothing'),
                'door_number' => trans('site.nothing'),
                'shaka_number' => trans('site.nothing'),
            ]
        );
    }
}
