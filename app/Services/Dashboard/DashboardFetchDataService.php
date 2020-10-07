<?php

namespace App\Services\Dashboard;

use App\Models\Order;
use Str;
use Illuminate\Http\Request;
use App\Services\BaseService;

class DashboardFetchDataService extends BaseService
{
    private $filters = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    private $queryText = "(SELECT COUNT(*) FROM orders WHERE status='?' and customer_id ='?') AS '?_count'";
    private $adminType;
    public function index(Request $request)
    {
        $this->adminType = $request->adminType;
        return $this->identify($request)->index($request);
    }

    protected function orderFilters($query)
    {
        foreach ($this->filters as $index) {
            $data = $query->selectRaw(Str::replaceArray('?', [$index, $index], $this->queryText));
        }
        return $data;
    }

}
