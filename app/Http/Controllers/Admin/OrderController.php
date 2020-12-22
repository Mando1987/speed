<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Repositories\Factories\MainFactory;
use App\Http\Requests\OrderEditFormRequest;
use App\Http\Requests\OrderStoreFormRequest;
use App\Http\Requests\ValidateOrderCustomerFormRequest;
use App\Http\Requests\ValidateOrderReciverFormRequest;
use App\Http\Services\ProviderClass;
use App\Http\Traits\FormatedResponseData;
use App\Models\Reciver;
use App\Services\Orders\OrderCountChargePrice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use FormatedResponseData;
    private $orderFactory;

    public function __construct(MainFactory $orderFactory)
    {
        $this->orderFactory = $orderFactory->getInstance(OrderRepositoryInterface::class);
    }
    public function index(Request $request)
    {
        return $this->OrderRepositoryInterface->getAll($request);
    }

    public function show(Request $request, $id)
    {
        return $this->OrderRepositoryInterface->showById($request, $id);
    }

    public function create(Request $request)
    {
        return $this->orderFactory->create($request);
    }

    public function validateCustomer(ValidateOrderCustomerFormRequest $request)
    {
        $data = $request->validated();
        $customerData = [
            'page' => 'reciver',
            'customer' => ['data' => $data['customer'], 'type' => $data['customerType']],
        ];
        if ($data['customerType'] == 'new') {
            $customerId = 0;
            $customerData['customer']['address'] = $data['customerAddress'];
        } else {
            $customerId = $data['customer']['id'];
        }
        session(['orderData' => $customerData]);

        $data = $this->formatData('validateCustomer', [
            'showClass' => 'reciver', 'allRecivers' => $this->getRecivers($customerId),
        ]);
        return response()->json($data);
    }

    public function getRecivers(int $customerId)
    {
        if ($customerId > 0) {
            $recivers = Reciver::select('id', 'fullname')->where('customer_id', $customerId)->get();
            if ($recivers->count() > 0) {
                return $recivers;
            }
        }
        return [['id' => null, 'fullname' => trans('site.no_recivers_for_customer')]];
    }

    public function validateReciver(ValidateOrderReciverFormRequest $request)
    {
        $data = $request->validated();
        // session()->push('user.teams', 'developers');
        $reciverData = [
            'page' => 'order',
            'reciver' => ['data' => $data['reciver'], 'type' => $data['reciverType']],
        ];
        if ($data['reciverType'] == 'new') {
            $city_id = $data['reciver']['city_id'];
            $reciverData['reciver']['address'] = $data['reciverAddress'];
        } else {
            $city_id = Reciver::find($data['reciver']['id'])->city->id;
        }
        session([
            'orderData' => array_merge(session('orderData'),array_merge($reciverData, ['reciver_city_id' => $city_id]))
        ]);
        $data = $this->formatData('validateReciver', [
            'showClass' => 'order',
        ]);
        return response()->json($data);

    }

    public function store(OrderStoreFormRequest $request)
    {
        return $this->orderFactory->store($request);
    }

    public function getOrderChargePrice(Request $request)
    {
        return app(OrderCountChargePrice::class)->getOrderChargePrice($request, true);
    }

    function print(Request $request) {
        // return $this->OrderRepositoryInterface->print($request);
    }

    public function viewEditPanel(Request $request)
    {
        return view('order.view_edit_panel', ['request' => $request]);
    }
    public function editOrder(Request $request)
    {
        return $this->OrderRepositoryInterface->editOrder($request);
    }
    public function update(OrderEditFormRequest $orderEditFormRequest, $id)
    {
        return $this->OrderRepositoryInterface->update($orderEditFormRequest, $id);

    }

    public function viewDeleteDaialog($id)
    {
        return view('includes.delete');
    }


}
