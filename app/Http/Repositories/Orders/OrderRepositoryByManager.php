<?php
namespace App\Http\Repositories\Orders;

use App\Models\Reciver;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Traits\OrderTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\BaseRepository;
use App\Http\Traits\FormatedResponseData;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Interfaces\OrderRepositoryInterface;

class OrderRepositoryByManager extends BaseRepository implements OrderRepositoryInterface
{
    use OrderTrait, FormatedResponseData;

    private $customer;
    private $reciver;
    private $order;

    public function create(Request $request)
    {
        $customersCount = Customer::all()->count();
        return view('order.create.create', [
            'customersCount' => $customersCount,
            'userData' => $request->all(),
        ]);
    }
    public function getAll(Request $request)
    {
    }

    public function showById(Request $request, $id)
    {
    }
    public function store(OrderStoreFormRequest $request)
    {
        $page = session('orderData')['page'];
        if ($page == 'order') {
            try {
                $data = $request->validated();
                DB::beginTransaction();
                $this->storeCustomerData($data['customer']);
                $this->storeReciverData($data['reciver']);
                $this->storeOrderData(array_merge($data['order'], ['status' => 'under_preparation']));
                $this->storeOrderShippingData($data['shipping']);
                DB::commit();

                session()->forget('orderData');
                $data = $this->formatData('validateOrder', [
                ],
                     [
                            'title' => trans('site.added'),
                            'icon' => 'success',
                            'html' => view('includes.alerts.order')->toHtml(),
                    ]
                );
                return response()->json($data);
            } catch (\Exception $ex) {
                DB::rollback();
                $data = $this->formatData('validateOrder',
                [
                    'error' => $ex->getMessage()
                ],
                     [
                            'title' => trans('site.added'),
                            'icon' => 'success',
                            'html' => view('includes.alerts.order')->toHtml(),
                    ]
                );
                return response()->json($data);
            }
        } else {
            return response()->json(['showClass' => $page, 'status' => 200]);
        }
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
    /**
     * store customer data in db
     *
     * @param array $data
     * @return void
     */
    private function storeCustomerData(array $data)
    {
        if ($data['customerType'] == 'new') {
            $customer = Customer::create($data['data']);
            $customer->address()->create($data['address']);
        } else {
            $customer = $data['data']['id'];
        }
        $this->customer = $customer;
    }
    /**
     * store reciver data in db
     *
     * @param array $data
     * @return void
     */
    private function storeReciverData(array $data)
    {
        if ($data['reciverType'] == 'new') {
            $reciver = Reciver::make($data['data']);
            $reciver->customer()->associate($this->customer)->save();
            $reciver->address()->create($data['address']);
        } else {
            $reciver = $data['data']['id'];
        }
        $this->reciver = $reciver;
    }
}
