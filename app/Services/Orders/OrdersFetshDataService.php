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
        $className     = __CLASS__ .'By'.Str::ucfirst($type);
        $this->admin   = $identify->$type;
        $this->identifyOrdersFetch = (new $className);

    }
    public function index($request)
    {
        $this->setView($request->view ?? null);
        return $this->identifyOrdersFetch->index(
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
    public function show($id)
    {
        return $this->identifyOrdersFetch->show([$this->type => $this->admin,'id' => $id]);
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

}
