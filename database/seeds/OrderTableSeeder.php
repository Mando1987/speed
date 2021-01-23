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
        $customer = factory(Customer::class, 1)->create();

        $reciver = factory(Reciver::class, 1)->create([
            'customer_id' => $customer[0]->id,
        ]);
        $order = factory(Order::class)->create([
            'customer_id' => $customer[0]->id,
            'reciver_id' => $reciver[0]->id,
        ]);
        $order->shipping()->create($this->shipping());
        $order->statuses()->create([
            'step' => 'possibility_of_delivery',
            'status' => 'under_preparation',
        ]);
    }

    public function shipping()
    {
       return [
        'weight'                  => 0.5,
        'quantity'                =>  4,
        'price'                   => 500,
        'charge_price'            => 100,
        'total_price'             => 600,
        'charge_on'               => 'reciver',
        'total_weight'            => 2,
        'total_over_weight'       => 1,
        'total_over_weight_price' => 50,
        'discount'                => 0,
        'order_num'               => rand(4444,9999),
    ];
    }
}
