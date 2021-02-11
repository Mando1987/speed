<?php

namespace Tests\Feature;

use App\Http\Traits\Tests\ActingAs;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Reciver;
use App\Models\Shipping;
use App\Notifications\Telegram\NotifyAddNewOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class OrderByManagerTest extends TestCase
{
    use RefreshDatabase, ActingAs;

    public function test_manager_can_see_orders()
    {
        $this->actingAsManager()->get('/order')
            ->assertStatus(200);
    }

    public function test_manager_can_validate_new_customer_data()
    {
        $customerData = factory(Customer::class)->make()->toArray();
        $customerAddress = factory(Address::class)->make()->toArray();

        $this->actingAsManager()->post(route('order.validate_customer'), [
            'customerType' => 'new',
            'customer' => $customerData,
            'customerAddress' => $customerAddress,
        ])
            ->assertSessionHas('orderData.page', 'reciver')
            ->assertSessionHas('orderData.customer.data', $customerData)
            ->assertSessionHas('orderData.customer.address', $customerAddress);
    }

    public function test_manager_can_validate_existing_customer_data()
    {
        $customer = factory(Customer::class)->create();
        $customerData = ['id' => $customer->id];

        $this->actingAsManager()->post(route('order.validate_customer'), [
            'customerType' => 'exists',
            'customer' => $customerData,
        ])
            ->assertSessionHas('orderData.page', 'reciver')
            ->assertSessionHas('orderData.customer.data', $customerData);
    }

    public function test_manager_can_validate_new_reciver_data()
    {
        $reciverData = factory(Reciver::class)->make()->toArray();
        $reciverAddress = factory(Address::class)->make()->toArray();

        $this->actingAsManager()->post(route('order.validate_reciver'), [
            'reciverType' => 'new',
            'reciver' => $reciverData,
            'reciverAddress' => $reciverAddress,
        ])
            ->assertSessionHas('orderData.page', 'order')
            ->assertSessionHas('orderData.reciver.data', $reciverData)
            ->assertSessionHas('orderData.reciver.address', $reciverAddress);
    }

    public function test_manager_can_validate_existing_reciver_data()
    {
        $reciver = factory(Reciver::class)->create();
        $reciverData = ['id' => $reciver->id];

        $this->actingAsManager()->post(route('order.validate_reciver'), [
            'reciverType' => 'exists',
            'reciver' => $reciverData,
        ])
            ->assertSessionHas('orderData.page', 'order')
            ->assertSessionHas('orderData.reciver.data', $reciverData);
    }
    public function test_manager_can_add_new_order()
    {
        Notification::fake();
        $customer = [
            'type' => 'new',
            'data' => factory(Customer::class)->make()->toArray(),
            'address' => factory(Address::class)->make()->toArray(),
        ];
        $reciver = [
            'type' => 'new',
            'data' => factory(Reciver::class)->make()->toArray(),
            'address' => factory(Address::class)->make()->toArray(),
        ];

        $orderData = [
            'customer' => $customer,
            'reciver' => $reciver,
            'page' => 'order',
            'reciver_city_id' => 1,
        ];
        $data = [
            'order' => factory(Order::class)->make()->toArray(),
            'shipping' => factory(Shipping::class)->make()->toArray(),
        ];
        $orders = Order::all()->count();
        $this->actingAsManager()->withSession(['orderData' => $orderData])
            ->post(route('order.store'), $data)
            ->assertStatus(200);
        $this->assertDatabaseCount('orders', $orders + 1);
        Notification::shouldReceive(new NotifyAddNewOrder(
            factory(Order::class)->create([
                'status' => 'under_review',
                'customer_id' => 1,
                'reciver_id' => 1,
            ])
        ));
    }
}
