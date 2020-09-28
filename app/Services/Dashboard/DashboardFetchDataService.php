<?php

namespace App\Services\Dashboard;

use Str;
use App\Services\BaseService;

class DashboardFetchDataService extends BaseService
{
    private $admin;
    private $type;
    private $identifyOrdersFetch;

    public function __construct()
    {
        $identify      = auth('admin')->user();
        $this->type    = $identify->type;
        $type          = $this->type;
        $className     = __CLASS__ . Str::title('By'.$type);
        $this->admin   = $identify->$type;
        $this->identifyOrdersFetch = (new $className);
    }
    public function index()
    {
        return $this->identifyOrdersFetch->index($this->admin);
    }
}
