<?php

namespace App\Services\Customers;
use App\Services\BaseService;

class CustomersFetshDataService extends BaseService
{
    protected $paginate = 6;
    protected $view = 'list';

    public function index($request)
    {
        $this->setView($request->view ?? null);
        return $this->identify($request)->index(
            (object) array_merge(
                $request->all(),
                [
                    'search' => $request->search ?? false,
                    'view' => $this->view,
                    'paginate' => $this->paginate,
                ]
            )
        );
    }
    public function show($request, $id)
    {
        $relationsLoded = ['reciver', 'reciver.city', 'reciver.address', 'shipping'];
        if ($request->adminType == 'manager') {
            $relationsLoded = array_merge($relationsLoded, ['customer', 'customer.city', 'customer.address']);
        }
        $orderData = Order::with($relationsLoded)->where('id', $id)->first();

        return view(
            'order.show.' . $request->adminType,
            [
                'order' => $orderData,
            ]
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

}
