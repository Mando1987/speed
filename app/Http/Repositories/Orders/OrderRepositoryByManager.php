<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\BaseRepository;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\OrderTrait;
use App\Models\Customer;
use App\Models\Reciver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRepositoryByManager implements OrderRepositoryInterface
{
    use OrderTrait, FormatedResponseData;

    public function getAll(Request $request)
    {
    }

    public function showById(Request $request, $id)
    {
    }

    function print(Request $request) {

        $orderData = $this->order::with(['reciver', 'shipping', 'customer'])
            ->whereId($request->orderId)->where(function ($query) use ($request) {
            return $query->when($request->adminIsCustomer, function ($q) use ($request) {
                return $q->whereCustomerId($request->adminId);
            });
        })->first();

        if ($orderData) {
            $this->cities_id[] = $orderData->reciver->city_id;
            $this->governorates_id[] = $orderData->reciver->governorate_id;
            if ($request->adminIsManager) {
                $this->cities_id[] = $orderData->customer->city_id;
                $this->governorates_id[] = $orderData->customer->governorate_id;
                $this->setCityRelationship($orderData, 'customer');
                $this->setAddressRelationship($orderData, 'customer');
                $this->setGovernorateRelationship($orderData, 'customer');
            }
            $this->setCityRelationship($orderData, 'reciver');
            $this->setAddressRelationship($orderData, 'reciver');
            $this->setGovernorateRelationship($orderData, 'reciver');
        }
        return view('order.print', ['order' => $orderData]);

    }

    public function editOrder(Request $request)
    {
        $editType = [
            'edit_customer' => 'customer',
            'edit_reciver' => 'reciver',
            'edit_order' => 'order',
        ];

        $order = $this->order::find($request->order_id);
        if ($order) {
            if (array_key_exists($request->edit_type, $editType)) {
                $type = $editType[$request->edit_type];
                if ($type == 'order') {

                    session(
                        ['reciver' => [
                            'chooseType' => 'exists',
                            'existingId' => $order->reciver->id],
                        ]
                    );

                    return view('order.edit.' . $type, [
                        'userData' => [
                            'order' => $order,
                            'shipping' => $order->shipping,
                        ], 'adminIsManager' => $request->adminIsManager,
                    ]);
                }
                return view('order.edit.' . $type, [
                    'userData' => [
                        $type => $order->$type,
                        'address' => $order->$type->address,
                    ], 'city_id' => $order->$type->city_id,
                ]
                );
            }
        }
        return abort(404);

    }

    public function update(OrderEditFormRequest $request, $id)
    {

    }

}