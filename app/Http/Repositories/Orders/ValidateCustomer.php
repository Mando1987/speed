<?php
namespace App\Http\Repositories\Orders;

use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\GetAllRecivers;
use Illuminate\Http\JsonResponse;

class ValidateCustomer
{
    use FormatedResponseData, GetAllRecivers;

    public static function handle($request) :JsonResponse
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
        $data = static::formatData('validateCustomer', [
            'showClass' => 'reciver', 'allRecivers' => static::getRecivers($customerId),
        ]);
        return response()->json($data);
    }
}
