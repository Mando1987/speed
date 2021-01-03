<?php
namespace App\Http\Repositories\Orders;

use Log;
use App\Models\Reciver;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Events\CreateNewOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\FormatedResponseData;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Services\AlertFormatedDataJson;
use App\Http\Traits\Orders\CreateOrderTrait;
use App\Http\Interfaces\CreateOrderRepositoryInterface;

class CreateOrderRepositoryByCustomer implements CreateOrderRepositoryInterface
{
    use CreateOrderTrait, FormatedResponseData;

    public function create(Request $request): View
    {
        $recivers = Reciver::select('id', 'fullname')->whereCustomerId($request->adminId)->get();
        return view('order.create.createByCustomer', [
            'recivers' => $recivers,
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
                $customerId = $request->adminId;
                $reciverId = $this->storeReciverData($data['reciver'], $customerId);
                $order = $this->storeOrderData(array_merge($data['order'], ['status' => 'under_review']), $customerId, $reciverId);
                $this->createOrderStatusFirstStep($order, 'under_review');
                $this->storeOrderShippingData($data['shipping'], $order->id);
                DB::commit();
                event(new CreateNewOrder($order->load('customer')));
                $this->forgetOrderDataFromSession();

                return (new AlertFormatedDataJson('validateOrder'))->alertBody(
                   'includes.alerts.order',
                   trans('site.added')
                )->formatedData();
            } catch (\Exception $ex) {
                DB::rollback();
                Log::error($ex->getMessage());
                return AlertFormatedDataJson::alertServerError('order.create');
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
    }

}
