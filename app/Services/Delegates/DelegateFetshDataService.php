<?php

namespace App\Services\Delegates;

use App\Models\City;
use App\Models\Governorate;
use App\Services\BaseService;


class DelegateFetshDataService extends BaseService
{
    const IMAGE_PATH = 'orders/';

    public function create()
    {
        return $this->viewCreateWithGovernorates('delegate.create');
    }

}
