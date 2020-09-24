<?php

namespace App\Services;

use App\Http\Requests\CustomerOrderStoreRequest;
use App\Http\Requests\ManagerOrderStoreFormRequest;
use App\Services\Orders\ManagerOrderCreateStoreService;
use App\Services\Orders\CustomerOrderCreateStoreService;

class CurrentAdminService
{
    private $admin;
    private $type;
    public $route;

    public function __construct()
    {
        $this->admin = auth('admin')->user();
        $this->type = $this->admin->type;
    }

    public function getId()
    {
        $type = $this->type; // customer ,delegate or admin
        return $this->admin->$type->id;
    }

    public function customer()
    {
        return $this->admin->customer;
    }

    private function setRouteName()
    {
        if ($this->type == 'customer') {
            $this->route = 'dashboard.index';
        }
    }

    public function order()
    {

        if ($this->type == 'customer') {
            return app(CustomerOrderCreateStoreService::class);
        }

        return app(ManagerOrderCreateStoreService::class);
    }

    public function orderFormRequest()
    {
        if ($this->type == 'customer') :
            return app(CustomerOrderStoreRequest::class);
        endif;

        return app(ManagerOrderStoreFormRequest::class);
    }
}
