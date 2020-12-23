<?php
namespace App\Http\Repositories\Orders;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\FormatedResponseData;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Traits\Orders\CreateOrderTrait;
use App\Http\Interfaces\CreateOrderRepositoryInterface;
use Illuminate\View\View;

class CreateOrderRepositoryByManager implements CreateOrderRepositoryInterface
{
    use CreateOrderTrait, FormatedResponseData;
    /**
     * show create page
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request) :View
    {
        $customersCount = Customer::all()->count();
        return view('order.create.createByManager', [
            'customersCount' => $customersCount,
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
                $customerId = $this->storeCustomerData($data['customer']);
                $reciverId = $this->storeReciverData($data['reciver'], $customerId);
                $orderId = $this->storeOrderData(array_merge($data['order'], ['status' => 'under_preparation']), $customerId, $reciverId);
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
