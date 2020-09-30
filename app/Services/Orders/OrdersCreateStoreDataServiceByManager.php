<?php
namespace App\Services\Orders;

use App\Models\Order;
use App\Models\Reciver;
use App\Models\Sender;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class OrdersCreateStoreDataServiceByManager extends BaseService
{
    const IMAGE_PATH = 'orders/';

    public $route = 'order.index';

    public function store($request)
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
                $sender  = Sender::create($request->validated()['sender']);
                $reciver = Reciver::create($request->validated()['reciver']);
                $order   = Order::create(array_merge(
                    $request->validated()['order'],
                    [
                        'sender_id'  => $sender->id,
                        'reciver_id' => $reciver->id

                    ]
                ));
                $order->shipping()->create(array_merge(
                    $request->validated()['shipping'],
                    ['order_num' => $this->setOrderNumberUnique($order->id)]
                ));
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

    public function create()
    {
        $userData = app(OrderSaveUserDataToSession::class)->handle(request('page'));
        return view('order.create.manager', ['userData' => $userData]);

    }

    private function orderPath($request, $page)
    {
        session(['page' =>  $page]);
        (isset($request->validated()['sender'])) ? session(['sender' => $request->validated()['sender']]):false;
        (isset($request->validated()['reciver'])) ? session(['reciver' => $request->validated()['reciver']]):false;
        return redirect()->route('order.create', ['page' => $page]);
    }
    private function setOrderNumberUnique($orderId)
    {
        return   3018 . ($orderId + 4);
    }
}
