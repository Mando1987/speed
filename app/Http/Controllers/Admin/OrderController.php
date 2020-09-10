<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreFormRequest;
use App\Services\Orders\OrdersFetshDataService;

class OrderController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
       return app(OrdersFetshDataService::class)->createNewOrder();
    }

    public function store(OrderStoreFormRequest $request)
    {

        // return $request->validated();
       if(session('page') == 1){

        session(['page' =>  2]);
        return redirect()->route('order.create' , ['page' => 2]);

       }

       if(session('page') == 2 && session('sender') ){

        session(['page' =>  3]);
        return redirect()->route('order.create' , ['page' => 3]);

      }
       if(session('page') == 3 && session('sender') && session('reciver') ){

        $data = array_merge($request->validated() , session('sender') ,session('reciver') );
        session()->forget(['sender' , 'reciver' , 'page']);

        return $data;
        // return redirect()->route('order.index');

      }
    }
}
