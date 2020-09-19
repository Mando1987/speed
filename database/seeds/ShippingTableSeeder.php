<?php

use App\Models\Order;
use App\Models\Reciver;
use App\Models\Sender;
use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingTableSeeder extends Seeder
{

    public function run()
    {

        try{

            DB::beginTransaction();

            Shipping::destroy(Shipping::all()->pluck('id'));
            Order::destroy(Order::all()->pluck('id'));
            Reciver::destroy(Reciver::all()->pluck('id'));
            Sender::destroy(Sender::all()->pluck('id'));
            factory(Shipping::class,30)->create();

             DB::commit();
        }catch(\Exception $ex){
            DB::rollBack();
        }
    }
}
