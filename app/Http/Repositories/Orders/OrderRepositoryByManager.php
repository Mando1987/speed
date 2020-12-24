<?php
namespace App\Http\Repositories\Orders;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\OrderTrait;
use App\Models\Address;
use App\Models\City;
use App\Models\Customer;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\Reciver;
use Illuminate\Http\Request;

class OrderRepositoryByManager implements OrderRepositoryInterface
{
    use OrderTrait, FormatedResponseData;

    public function getAll(Request $request)
    {
        $this->setViewSetting($request);
        $orders = Order::WithDefaultRealtions()->WithCustomerRelationship()->latest()->paginate($this->paginate);

        return view(
            'order.index.' . $request->adminType,
            [
                'orders' => $orders,
                'view' => $this->view,
                'status' => $request->status ?? 'all',
                'search' => $request->search,
            ]
        );
    }

    public function showById(Request $request, $id)
    {
        $query = Order::with(['reciver', 'shipping']);
        $query = $request->adminIsManager ? $query->with(['customer']) : $query;
        $orderData = $query->whereId($id)->where(function ($query) use ($request) {
            return $query->when($request->adminIsCustomer, function ($q) use ($request) {
                return $q->whereCustomerId($request->adminId);
            });
        })->first();

        if ($orderData) {
            $this->cities_id[] = $orderData->reciver->city_id;
            $this->governorates_id[] = $orderData->reciver->governorate_id;
            $request->adminIsManager ?
            ($this->cities_id[] = $orderData->customer->city_id)
            && ($this->governorates_id[] = $orderData->customer->governorate_id)
            && $this->setCityRelationship($orderData, 'customer')
            && $this->setAddressRelationship($orderData, 'customer')
            && $this->setGovernorateRelationship($orderData, 'customer')
            : false;
            $this->setCityRelationship($orderData, 'reciver');
            $this->setAddressRelationship($orderData, 'reciver');
            $this->setGovernorateRelationship($orderData, 'reciver');
        }

        return view('order.show.' . $request->adminType, ['order' => $orderData]);
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
    {}
    private function setViewSetting(Request $request)
    {
        $viewSetting = session('viewSetting');
        $this->view = $request->view ?? $viewSetting['view'] ?? 'list';
        $this->paginate = $request->paginate ?? $viewSetting['paginate'] ?? 10;
        session(['viewSetting' => ['view' => $this->view, 'paginate' => $this->paginate]]);
    }

    public function setAddressRelationship($model, $relation)
    {
        $relations = ['reciver' => 'App\\Models\\Reciver', 'customer' => 'App\\Models\\Customer'];
        $this->address = $this->address ?? Address::get();

        $this->address->map(function ($address) use ($model, $relation, $relations) {
            if ($address->addressable_type == $relations[$relation] && $address->addressable_id == $model->$relation->id) {
                $model->$relation->address = $address;
            }
        });

        return $model;
    }

    public function setCityRelationship($model, $relation)
    {
        $this->city = $this->city ?? City::whereIn('id', $this->cities_id)->get();
        $this->city->map(function ($city) use ($model, $relation) {
            if ($city->id == $model->$relation->city_id) {
                return $model->$relation->city = $city;
            }
        });
        return $model;
    }
    public function setGovernorateRelationship($model, $relation)
    {
        $this->governorate = $this->governorate ?? Governorate::whereIn('id', $this->governorates_id)->get();
        $this->governorate->map(function ($governorate) use ($model, $relation) {
            if ($governorate->id == $model->$relation->governorate_id) {
                return $model->$relation->governorate = $governorate;
            }
        });
        return $model;
    }

}
