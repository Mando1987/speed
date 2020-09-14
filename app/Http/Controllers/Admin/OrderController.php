<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreFormRequest;
use App\Models\PlacePrice;
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

        if (session('page') == 1) {

            session(['page' =>  2]);
            session($request->validated());
            return redirect()->route('order.create', ['page' => 2]);
        }

        if (session('page') == 2 && session('sender')) {

            session(['page' =>  3]);
            session($request->validated());
            return redirect()->route('order.create', ['page' => 3]);
        }
        if (session('page') == 3 && session('sender') && session('reciver')) {

            $data['order']   = $request->validated()['order'];
            $data['sender']  = session('sender');
            $data['reciver'] = session('reciver');
            session()->forget(['sender', 'reciver', 'page']);

            return $data;
            // return redirect()->route('order.index');

        }
    }

    public function getOrderChargePrice(Request $request)
    {

        $reciver = session('reciver');

        $chargeprice = PlacePrice::where('governorate_id', $reciver['governorate_id'])->where('city_id', $reciver['city_id'])->first();

        if ($chargeprice) {
            $request->validate(
                [
                    'weight'   => ['bail', 'required'],
                    'quantity' => ['bail', 'required', 'integer'],
                ],
                [],
                [
                    'weight' => trans('site.weight'),
                    'quantity' => trans('site.quantity'),
                ]
            );

            $total_weight = floor($request->weight * $request->quantity);
            $total_over_weight =  $total_weight - $chargeprice->send_weight ;
            $total_over_weight_price = ($total_over_weight/$chargeprice->weight_addtion) * $chargeprice->price_addtion;

            return response()->json([
                'total_weight'            => $total_weight ,
                'total_over_weight'       => $total_over_weight ,
                'total_over_weight_price' => $total_over_weight_price
            ]);
        }else{
            return response()->json(['showModelAddPlacePrice' => true]);
        }
    }
}
