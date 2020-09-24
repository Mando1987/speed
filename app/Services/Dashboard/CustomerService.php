<?php

namespace App\Services\Dashboard;

use App\Services\currentAdminService;
use Illuminate\Database\Eloquent\Builder;

class CustomerService
{

    protected $customer;

    public function __construct()
    {

        $this->customer = app(currentAdminService::class)->customer();
    }

    public function index()
    {
        $filters = [
            'under_review',
            'under_preparation',
            'my_balance',
            'ready_to_chip',
            'delivered',
            'postpond',
            'cancelld',
        ];


        $allStatus = [];

        foreach ($filters as $index) {

            $allStatus['orders as ' . $index . '_count'] = function ($q) use ($index) {

                $q->where('status', $index);
            };
        }

        $allStatus[] = 'orders as all_count';

        $data = $this->customer->select('id')->withCount($allStatus)->first();

       // return $data;

        // $all = $this->customer->select('id')->with(['orders' => function($q){

        //     $q->select('id', 'customer_id','status')
        //       ->where('status','under_review');

        // } , 'orders.shipping' => function($q){
        //     $q->select('id', 'price', 'order_id');

        // }])->first();

        // $totalPrice = 0;
        //  $all->orders->map(function($item) use(&$totalPrice){

        //      $totalPrice =  $totalPrice + $item->shipping->price;
        // });

        // return $totalPrice;



        // return $data;
        return view('dashboard.customer', ['data' => $data]);
    }
}
