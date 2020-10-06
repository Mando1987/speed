<?php

namespace App\Services\Customers;


use App\Models\Customer;

class CustomersFetshDataServiceByManager extends CustomersFetshDataService
{
    private $searchColumns = [
        'customers.fullname',
        'customers.phone',
    ];

    public function index($request)
    {
        $customers = Customer::leftJoin('addresses',function($join){
            $join->on('addresses.addressable_id', 'customers.id')
            ->where('addresses.addressable_type' ,'App\Models\Customer');
        })
        ->addSelect('customers.*')
        ->addSelect('addresses.*')

            ->where(function ($query) use ($request) {
                return $query->when($request->customer_type == 'registered',function($qtype){
                    $qtype->whereNotNull('customers.admin_id');
                })
                ->when($request->search, function ($qsearch) use ($request) {
                    $columns = $qsearch->where('customers.fullname', 'LIKE', '%' . $request->search . '%');

                    foreach ($this->searchColumns as $key) {
                        $columns = $columns->orWhere($key, 'LIKE', "%{$request->search}%");
                    }
                    return $columns;
                });

            })
             ->latest('customers.id')
            ->paginate($request->paginate);

       // return $customers;

        // foreach ($orders as $index => &$order) {
        //     $order->city = app()->getLocale() == 'ar' ? $order->city_name:$order->city_name_en;
        //     $order->date = $order->created_at->format('Y-m-d');
        //     $order->getStatus = trans('site.order_status_' . $order->status);
        // }
        return view(
            'customer.index.'. $request->adminType,
            [
                'customers' => $customers,
                'view' => $request->view,
                'customer_type' => $request->customer_type ?? 'registered',
                'search' => $request->search,
            ]
        );
    }
    // public function show($request, $id)
    // {
    //     $order = Order::with(['shipping', 'reciver', 'reciver.city', 'customer', 'customer.city'])
    //         ->where('id', $id)
    //         ->first();

    //     return view(
    //         'order.show.' . $request->adminType,
    //         [
    //             'order' => $order,
    //         ]
    //     );
    // }
}
