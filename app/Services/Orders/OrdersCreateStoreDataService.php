<?php

namespace App\Services\Orders;

use Illuminate\Support\Str;
use App\Services\BaseService;

class OrdersCreateStoreDataService extends BaseService
{
    private $admin;
    private $type;
    private $identifyOrdersFetch;

    public function __construct()
    {
        $identify      = auth('admin')->user();
        $this->type    = $identify->type;
        $type          = $this->type;
        $className     = __CLASS__ .'By'.Str::ucfirst($type);
        $this->admin   = $identify->$type;
        $this->identifyOrdersFetch = (new $className);

    }

    public function create()
    {
        return $this->identifyOrdersFetch->create();
    }

    public function store($request)
    {
        return $this->identifyOrdersFetch->store($request);
    }


}
