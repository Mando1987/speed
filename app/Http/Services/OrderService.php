<?php
namespace App\Http\Services;

use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\GetAllRecivers;
use App\Models\Reciver;

class OrderService
{
    use FormatedResponseData, GetAllRecivers;

    public function saveCustomerDataToSession(array $customerValidatedData)
    {
        $data = $customerValidatedData;
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
        $data = static::formatData('validateCustomer', [
            'showClass' => 'reciver', 'allRecivers' => static::getRecivers($customerId),
        ]);
        return response()->json($data);
    }
    public function saveReciverDataToSession(array $reciverValidatedData)
    {
        $data = $reciverValidatedData;
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
        if (session()->has('orderData')) {
            session([
                'orderData' => array_merge(session('orderData'), array_merge($reciverData, ['reciver_city_id' => $city_id])),
            ]);
        } else {
            session([
                'orderData' => array_merge($reciverData, ['reciver_city_id' => $city_id]),
            ]);
        }
        $data = static::formatData('validateReciver', [
            'showClass' => 'order',
        ]);
        return response()->json($data);
    }
}
