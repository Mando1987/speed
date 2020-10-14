<?php
namespace App\Services\Orders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Reciver;
use App\Services\Orders\OrdersCreateStoreDataService;
use Illuminate\Support\Facades\DB;

class OrdersCreateStoreDataServiceByManager extends OrdersCreateStoreDataService
{

    public function store($request)
    {
        dd($request);
        if (session('page') == 1) {

            return $this->orderPath($request, 2);
        }

        if (session('page') == 2 && session('customer')) {

            return $this->orderPath($request, 3);
        }

        if (session('page') == 3 && session('customer') && session('reciver')) {

            try {

                DB::beginTransaction();
                $customer = Customer::create($request->validated()['customer']);
                $customer->address()->create($request->validated()['customerAddress']);
                $reciver = Reciver::create($request->validated()['reciver']);
                $reciver->address()->create($request->validated()['reciverAddress']);
                $order = Order::create(array_merge(
                    $request->validated()['order'],
                    [
                        'customer_id' => $customer->id,
                        'reciver_id' => $reciver->id,

                    ]
                ));
                $order->shipping()->create(array_merge(
                    $request->validated()['shipping'],
                    ['order_num' => $this->setOrderNumberUnique($order->id)]
                ));
                DB::commit();

                $this->forgetOrderData();
                $this->notify(['icon' => self::ICON_SUCCESS, 'title' => self::TITLE_ADDED]);
                return $this->path('order.index');
            } catch (\Exception $ex) {

                DB::rollback();
                $this->notify(['icon' => self::ICON_ERROR, 'title' => self::TITLE_FAILED]);

                dd($ex->getMessage());
                return back();
            }
        }
    }

}
