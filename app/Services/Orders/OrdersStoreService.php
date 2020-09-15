<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Models\Reciver;
use App\Models\Sender;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class OrdersStoreService extends BaseService
{
    const IMAGE_PATH = 'orders/';

    public $sender, $reciver, $order, $route = 'order.index';

    public function __construct(Sender $sender, Reciver $reciver, Order $order)
    {
        $this->sender  = $sender;
        $this->reciver = $reciver;
        $this->order   = $order;
    }

    public function handle($request)
    {
        if (session('page') == 1) {

            return $this->orderPath($request, 2);
        }

        if (session('page') == 2 && session('sender')) {

            return $this->orderPath($request, 3);
        }

        if (session('page') == 3 && session('sender') && session('reciver')) {

            try {

                DB::beginTransaction();
                $sender  = $this->sender::create($request['sender']);
                $reciver = $this->reciver::create($request['reciver']);
                $order   = $this->order::create(array_merge(
                    $request['order'],
                    [
                        'sender_id'  => $sender->id,
                        'reciver_id' => $reciver->id
                    ]
                ));
                $order->shipping()->create($request['shipping']);


                DB::commit();

                session()->forget(['sender', 'reciver', 'page']);
                $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
                return $this->path($this->route);
            } catch (\Exception $ex) {

                DB::rollback();
                $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

                dd($ex->getMessage());
                return back();
            }
        }
    }
    private function orderPath($request, $page)
    {
        session(['page' =>  $page]);
        session($request);
        return redirect()->route('order.create', ['page' => $page]);
    }
}
