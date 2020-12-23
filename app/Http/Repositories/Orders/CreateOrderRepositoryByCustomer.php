<?php
namespace App\Http\Repositories\Orders;

use App\Models\Reciver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\CreateOrderTrait;
use Illuminate\Http\JsonResponse;

class CreateOrderRepositoryByCustomer implements CreateOrderRepositoryInterface
{
    use CreateOrderTrait, FormatedResponseData;

    public function create(Request $request)
    {
        $recivers = Reciver::select('id', 'fullname')->whereCustomerId($request->adminId)->get();
        return view('order.create.createByCustomer', [
            'recivers' => $recivers,
            'userData' => $request->all(),
        ]);
    }
    /**
     * store order in database
     * @param \App\Http\Requests\OrderStoreFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStoreFormRequest $request) :JsonResponse
    {
        $page = session('orderData')['page'];
        if ($page == 'order') {
            try {
                $data = $request->validated();
                DB::beginTransaction();
                $customerId = $request->adminId;
                $reciverId = $this->storeReciverData($data['reciver'], $customerId);
                $orderId = $this->storeOrderData(array_merge($data['order'], ['status' => 'under_review']), $customerId, $reciverId);
                $this->storeOrderShippingData($data['shipping'], $orderId);
                DB::commit();
                $this->forgetOrderDataFromSession();
                return $this->responseDataJson(trans('site.added'));
            } catch (\Exception $ex) {
                DB::rollback();
                return $this->responseDataJson(trans('site.failed') , 'error');
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
    }

}
