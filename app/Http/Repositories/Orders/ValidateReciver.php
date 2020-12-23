<?php
namespace App\Http\Repositories\Orders;

use App\Models\Reciver;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\FormatedResponseData;
use App\Http\Traits\Orders\GetAllRecivers;

class ValidateReciver
{
    use FormatedResponseData, GetAllRecivers;
    /**
     *
     * @param [type] $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function handle($request) :JsonResponse
    {
        $data = $request->validated();
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
        if(session()->has('orderData'))
        {
        session([
            'orderData' => array_merge(session('orderData'),array_merge($reciverData, ['reciver_city_id' => $city_id]))
        ]);
        }else{
            session([
            'orderData' => array_merge($reciverData, ['reciver_city_id' => $city_id])
        ]);
        }
        $data = static::formatData('validateReciver', [
            'showClass' => 'order',
        ]);
        return response()->json($data);

    }
}
