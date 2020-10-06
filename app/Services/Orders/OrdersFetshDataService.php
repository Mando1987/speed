<?php

namespace App\Services\Orders;

use App\Models\City;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class OrdersFetshDataService extends BaseService
{
    protected $orderStatuses = [
        'under_review',
        'under_preparation',
        'ready_to_chip',
        'delivered',
        'postpond',
        'cancelld',
    ];
    protected $paginate = 6;
    protected $view = 'list';

    public function index($request)
    {
        $this->setView($request->view ?? null);
        return $this->identify($request)->index(
            (object) array_merge(
                $request->all(),
                [
                    'type' => $request->adminType,
                    'status' => ($request->status ?? false) && in_array($request->status, $this->orderStatuses) ? $request->status : false,
                    'search' => $request->search ?? false,
                    'view' => $this->view,
                    'paginate' => $this->paginate,
                ]
            )
        );
    }
    public function show($request, $id)
    {
        $cities = City::all();
        $citiesMap = $cities->mapWithKeys(function($city){
            return [$city->id => $city];
        });
        $relationsLoded = ['reciver' , 'shipping'];
        if($request->adminType == 'manager'){
            $relationsLoded = array_merge( $relationsLoded, ['customer']);
        }


         $orderData = Order::with($relationsLoded)->where('id',$id)->first();

         return $orderData;


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
