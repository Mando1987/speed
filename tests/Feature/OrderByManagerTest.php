<?php

namespace Tests\Feature;

use App\Http\Traits\Tests\ActingAs;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Reciver;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
    // public function test_manager_can_add_new_order()
    // {
    //     // $this->actingAsManager()->with->post(route('order.store'),[])->assertStatus(200);
    // }
}
