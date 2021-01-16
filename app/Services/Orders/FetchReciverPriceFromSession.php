<?php
namespace App\Services\Orders;

use App\Models\Reciver;
use App\Models\Setting;
use App\Models\PlacePrice;

class FetchReciverPriceFromSession
{
   public static function getPriceCharge() :object
   {
       $reciverdata = session('orderData')['reciver'];
       $reciverType = $reciverdata['type'];
       switch($reciverType){
           case "new" :
              return self::fetchPriceForNewReciver($reciverdata);
           case "exists" :
              return self::fetchPriceForExistsReciver($reciverdata);
       }

   }
  private static function fetchPriceForNewReciver($reciverdata)
  {
    return self::fetchPrice($reciverdata['data']['city_id']);
  }
  private static function fetchPriceForExistsReciver($reciverdata)
  {
     $city_id =  Reciver::find($reciverdata['data']['id'])->city_id;
     return self::fetchPrice($city_id);
  }

  private static function fetchPrice($city_id)
  {
     return PlacePrice::where('city_id', $city_id)->first() ??
            Setting::where('event', 'default_charge_price')->first()->data;
  }

}
