<?php

namespace App\Services\Dashboard;

use Str;
use App\Services\BaseService;

class DashboardFetchDataService extends BaseService
{
    private $admin;
    private $type;
    private $service;
    private $className;

    public function __construct()
    {
        $this->admin     = auth('admin')->user();
        $this->type      = $this->admin->type;
        $this->className =  __NAMESPACE__ . DIRECTORY_SEPARATOR . Str::ucfirst($this->type . 'Service');
        $this->service   = (new $this->className);
    }

    public function index()
    {
        return $this->service->index();
    }
}
