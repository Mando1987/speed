<?php
namespace App\Http\Repositories\Orders;

use App\Events\CreateNewOrder;
use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\CreateOrderTrait;
use App\Models\Reciver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Log;

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
                $this->storeOrderShippingData($data['shipping'], $order->id);
                DB::commit();
                event(new CreateNewOrder($order->load('customer')));
                $this->forgetOrderDataFromSession();
                return $this->responseDataJson(trans('site.added'));
            } catch (\Exception $ex) {
                DB::rollback();
                Log::error($ex->getMessage());
                return $this->responseDataJson(trans('site.failed'), 'error');
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
    }

}
