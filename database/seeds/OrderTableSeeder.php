<?php

use App\Models\Customer;
use App\Models\Order;
use App\Models\Reciver;
use App\Models\Shipping;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = factory(Customer::class)->create();

        $reciver = factory(Reciver::class)->create([
            'customer_id' => $customer->id,
        ]);
        $order = factory(Order::class)->create([
            'customer_id' => $customer->id,
            'reciver_id' => $reciver->id,
        ]);
        factory(Shipping::class)->create([
            'order_id' => $order->id
        ]);
        $order->statuses()->create([
            'step' => 'possibility_of_delivery',
            'status' => 'under_preparation',
        ]);
    }

}
