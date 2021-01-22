<?php

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderStatus;
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
        $customer = factory(Customer::class, 1)->create();

        $reciver = factory(Reciver::class, 1)->create([
            'customer_id' => $customer[0]->id,
        ]);
        $order = factory(Order::class)->create([
            'customer_id' => $customer[0]->id,
            'reciver_id' => $reciver[0]->id,
        ]);
        $order->shipping()->create(factory(Shipping::class)->make()->toArray());
        $order->statuses()->create(factory(OrderStatus::class)->make()->toArray());
    }
}
