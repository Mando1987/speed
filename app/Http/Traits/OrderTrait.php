<?php
namespace App\Http\Traits;

use App\Services\Orders\OrderSaveUserDataToSession;
use Illuminate\Http\Request;

trait OrderTrait
{
    public function create(Request $request)
    {
        $userData = app(OrderSaveUserDataToSession::class)->handle($request);
        return view('order.create.manager', ['userData' => $userData]);
    }

    protected function orderPath($request, $page)
    {
        $data = $request->validated();

        if (isset($data['customer'])) {
            session(['customer' => $data['customer']]);
            if(isset($data['address']))
               session(['customerAddress' => $data['address']]);
        }
        if (isset($data['reciver'])) {
            session(['reciver' => $data['reciver']]);
            if(isset($data['address']))
               session(['reciverAddress' => $data['address']]);

        }
        session(['page' =>  $page]);

        return redirect()->route('order.create', ['page' => $page ]);
    }

    protected function setOrderNumberUnique($orderId)
    {
        return   3018 . ($orderId + 4);
    }
}