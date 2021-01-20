<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AlertFormatedDataJson;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class OrderStatusController extends Controller
{
    private $order;
    private $steps = ['STEP1' => 'STEP1'];
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function changeStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $order = (new Order)->find($request->orderId);
            $order->status = $request->status;
            $order->save();
            $order->statuses()->create(
                [
                    'status' => $request->status, 'step' => $this->steps[$request->step],
                ]
            );
            DB::commit();
            return AlertFormatedDataJson::alertMessageOnly(trans('site.order_status_changed_successfuly'));
            Log::debug($request);
        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertMessageOnly(trans('site.order_status_changed_failed', 'error'));
        }
    }

    public function underPreparation(Request $request, Order $order)
    {
        $rules = ['ReceiptType' => ['required','in:Receipt_in_company,Receipt_by_delegate']];
        $request->ReceiptType == 'Receipt_by_delegate' ? $rules['delegate_id'] = ['required','exists:delegates,id'] :false;
        $request->validate($rules);
        try {
            DB::beginTransaction();
            $order->status = 'ready_to_receipt';
            $order->save();
            $order->statuses()->create(
                [
                    'status' => 'ready_to_receipt', 'step' => 'Receipt_from_the_customer', 'delegate_id' => $request->delegate_id ?? null
                ]
            );
            DB::commit();
            return AlertFormatedDataJson::alertMessageOnly(trans('site.order_status_changed_successfuly'));
            Log::debug($request);
        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertMessageOnly(trans('site.order_status_changed_failed', 'error'));
        }

    }

    public function ReceiptFromCustomer(Request $request, Order $order)
    {
        $rules = ['ReceiptProssess' => ['required','in:done'] , 'ReceiptWay' => ['in:GO_TO_STORAGE,GO_TO_CUSTOMER']];
        $status= ['GO_TO_STORAGE' => 'pickup_in_storage' , 'GO_TO_CUSTOMER' => 'ready_to_chip'];
        $request->validate($rules);

        $orderStatus = $status[$request->ReceiptWay];
        try {
            DB::beginTransaction();
            $order->status = $orderStatus;
            $order->save();
            $order->statuses()->create(
                [
                    'status' => $orderStatus, 'step' => 'Receipt_from_the_customer', 'delegate_id' => $request->adminId
                ]
            );
            DB::commit();
            return AlertFormatedDataJson::alertMessageOnly(trans('site.edited'));
            Log::debug($request);
        } catch (\Exception $ex) {
            DB::rollback();
            \Log::error($ex->getMessage());
            return AlertFormatedDataJson::alertMessageOnly(trans('site.order_status_changed_failed', 'error'));
        }

    }
}
