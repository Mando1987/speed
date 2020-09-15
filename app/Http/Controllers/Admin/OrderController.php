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
                    'weight'    => ['bail', 'required'],
                    'quantity'  => ['bail', 'required', 'integer'],
                    'price'     => ['bail', 'required', 'numeric'] ,
                    'charge_on' => ['bail', 'required', 'in:sender,reciver'] ,
                    'discount'  => ['nullable', 'numeric'] ,
                ],
                [],
                [
                    'weight'    => trans('site.order_weight'),
                    'quantity'  => trans('site.order_quantity'),
                    'price'     => trans('site.order_price'),
                    'charge_on' => trans('site.order_charge_on'),
                    // 'discount'  => trans('site.order_discount'),
                ]
            );

            $total_weight            = ceil($request->weight * $request->quantity);
            $total_over_weight       =  $total_weight - $chargeprice->send_weight ;
            $total_over_weight_price = ($total_over_weight/$chargeprice->weight_addtion) * $chargeprice->price_addtion;
            $discount                = $request->discount ?? 0;
            $charge_price            = ($total_over_weight_price + $chargeprice->send_price) - $discount;
            $addtion_price           = $request->charge_on == 'reciver' ?  $charge_price : 0;
            $total_price             = $request->price +  $addtion_price;

            return response()->json([
                'total_weight'            => $total_weight ,
                'total_over_weight'       => $total_over_weight ,
                'total_over_weight_price' => $total_over_weight_price,
                'charge_price'            => $charge_price,
                'total_price'             => $total_price
            ]);
        }else{
            return response()->json(['showModelAddPlacePrice' => true]);
        }
    }
}
