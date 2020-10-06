<?php
namespace App\Services\Orders;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class OrdersCreateStoreDataServiceByCustomer extends OrdersCreateStoreDataService
{

    public function store($request)
    {
        if (session('page') == 1) {

            return $this->orderPath($request, 2);
        }

        if (session('page') == 2 && session('reciver')) {
            try {

                DB::beginTransaction();
                $customer = Admin::find($request->adminId)->customer;

                $reciver = $customer->recivers()->create($request->validated()['reciver']);

                $reciver->address()->create($request->validated()['reciverAddress']);

                $order = $customer->orders()->create(array_merge(
                    $request->validated()['order'],
                    [
                        'reciver_id' => $reciver->id,
                    ]
                ));
                $order->shipping()->create(array_merge(
                    $request->validated()['shipping'],
                    ['order_num' => $this->setOrderNumberUnique($order->id)]
                ));

                $order->orderStatuses()->create(['status' => 'under_review']);

                $this->forgetOrderData();
                DB::commit();

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

}
