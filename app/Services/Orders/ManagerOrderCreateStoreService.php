<?php
namespace App\Services\Orders;

use App\Models\Order;
use App\Models\Reciver;
use App\Models\Sender;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class ManagerOrderCreateStoreService extends BaseService
{
    const IMAGE_PATH = 'orders/';

    public $sender, $reciver, $order, $route = 'order.index';

    public function __construct(Sender $sender, Reciver $reciver, Order $order)
    {
        $this->sender  = $sender;
        $this->reciver = $reciver;
        $this->order   = $order;
    }

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
                $sender  = $this->sender::create($request['sender']);
                $reciver = $this->reciver::create($request['reciver']);
                $order   = $this->order::create(array_merge(
                    $request['order'],
                    [
                        'sender_id'  => $sender->id,
                        'reciver_id' => $reciver->id

                    ]
                ));
                $order->shipping()->create(array_merge(
                    $request['shipping'],
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
        return view('order.create', ['userData' => $userData]);

    }

    private function orderPath($request, $page)
    {
        session(['page' =>  $page]);
        $request->reciver ? session(['reciver' => $request->reciver]):false;
        return redirect()->route('customer.order.create', ['page' => $page]);
    }
    private function setOrderNumberUnique($orderId)
    {
        return   3018 . ($orderId + 4);
    }
}
