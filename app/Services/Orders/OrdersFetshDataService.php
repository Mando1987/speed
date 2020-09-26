<?php

namespace App\Services\Orders;

use Illuminate\Support\Str;
use App\Services\BaseService;

class OrdersFetshDataService extends BaseService
{
    private $admin;
    private $type;
    private $identifyOrdersFetch;
    private $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    private $paginate = 6;
    private $view = 'list';

    public function __construct()
    {
        $identify      = auth('admin')->user();
        $this->type    = $identify->type;
        $type          = $this->type;
        $className     =  __NAMESPACE__ . '\\' . Str::ucfirst($type . 'OrderFetshDataService');
        $this->admin   = $identify->$type;
        $this->identifyOrdersFetch = (new $className);
    }

    public function handle($request)
    {
        $this->setView($request->view ?? null);

        return $this->identifyOrdersFetch->handle(
            (object) array_merge(
                $request->all(),
                [
                    $this->type => $this->admin,
                    'status'   => ($request->status ?? false) && in_array($request->status, $this->orderStatuses) ? $request->status : false,
                    'search'   => $request->search ?? false,
                    'view'     => $this->view,
                    'paginate' => $this->paginate,
                ]
            )
        );
    }
    private function setView($value = null)
    {
        if ($value == null && session('view')) {
            $this->view = session('view');
        } else {
            if ($value == 'grid' || $value == 'list') {
                $this->view = $value;
                session(['view' => $this->view]);
            }
        }
        $this->setPaginate();
        return $this;
    }
    private function setPaginate()
    {
        $this->paginate = 6;
        if ($this->view == 'list') {
            $this->paginate = 12;
        }
    }
    // public function editCityPriceRow($id)
    // {
    //     $city = $this->city::where('id', $id)->first();
    //     return view('place-prices.edit', [
    //         'city_price' => $city->placePrices,
    //         'city_name' => $city->name,
    //         'governorate_name' => $city->governorate->name,
    //     ]);
    // }
}
