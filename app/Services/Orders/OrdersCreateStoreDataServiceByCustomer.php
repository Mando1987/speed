<?php
namespace App\Services\Orders;

use App\Models\Admin;
use App\Services\BaseService;
use App\Services\CurrentAdminService;
use Illuminate\Support\Facades\DB;
use App\Services\Orders\OrderSaveUserDataToSession;

class OrdersCreateStoreDataServiceByCustomer extends BaseService
{
    const IMAGE_PATH = 'customers/profile/';

    private $admin;
    public $route = 'order.index';

    public function store($request)
    {
        if (session('page') == 1) {

            return $this->orderPath($request, 2);
        }

        if (session('page') == 2 && session('reciver')) {
            try {

                DB::beginTransaction();
                $customer = (new CurrentAdminService)->customer();

                $reciver = $customer->recivers()->create($request->validated()['reciver']);

                $order   = $customer->orders()->create(array_merge(
                    $request->validated()['order'],
                    [
                        'reciver_id' => $reciver->id
                    ]
                ));
                $order->shipping()->create(array_merge(
                    $request->validated()['shipping'],
                    ['order_num' => $this->setOrderNumberUnique($order->id)]
                ));

                $order->orderStatuses()->create(['status' => 'under_review']);

                session()->forget(['reciver', 'page']);
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

    public function create()
    {
        $userData = app(OrderSaveUserDataToSession::class)->handle(request('page'));
        return view('order.create.customer', ['userData' => $userData]);
    }

    private function orderPath($request, $page)
    {
        session(['page' =>  $page]);
        $request->validated()['reciver'] ? session(['reciver' => $request->validated()['reciver']]):false;
        return redirect()->route('order.create', ['page' => $page]);
    }
    private function setOrderNumberUnique($orderId)
    {
        return   3018 . ($orderId + 4);
    }
}
