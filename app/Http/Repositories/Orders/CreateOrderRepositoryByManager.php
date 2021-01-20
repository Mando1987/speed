<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\CreateOrderTrait;
use App\Models\Customer;
use App\Notifications\Telegram\NotifyAddNewOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CreateOrderRepositoryByManager implements CreateOrderRepositoryInterface
{
    use CreateOrderTrait, FormatedResponseData;

    public function create(Request $request): View
    {
        $customers = Customer::all();
        return view('order.create.createByManager', [
            'customers' => $customers,
            'userData' => $request->all(),
        ]);
    }

    public function store(OrderStoreFormRequest $request): JsonResponse
    {
        $page = session('orderData')['page'];
        if ($page == 'order') {
            try {
                $data = $request->validated();
                DB::beginTransaction();
                $customerId = $this->storeCustomerData($data['customer']);
                $reciverId = $this->storeReciverData($data['reciver'], $customerId);
                $order = $this->storeOrderData(array_merge($data['order'], ['status' => 'under_preparation']), $customerId, $reciverId);
                $this->createOrderStatusFirstStep($order);
                $this->storeOrderShippingData($data['shipping'], $order->id);
                DB::commit();
                $order->notify(new NotifyAddNewOrder($order));
                $this->forgetOrderDataFromSession();

                return (new AlertFormatedDataJson('validateOrder'))->alertBody(
                    'includes.alerts.order',
                    trans('site.added')
                )->formatedData();

            } catch (\Exception $ex) {
                DB::rollback();
                \Log::error($ex->getMessage());
                return AlertFormatedDataJson::alertServerError('order.create');
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
    }

}
