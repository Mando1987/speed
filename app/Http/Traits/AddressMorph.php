<?php
namespace App\Http\Traits;

trait AddressMorph
{
    public function address()
    {
        return $this->morphOne(\App\Models\Address::class , 'addressable')->withDefault(
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