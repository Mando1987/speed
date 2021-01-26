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
        factory(Shipping::class,1)->create();
    }
}
