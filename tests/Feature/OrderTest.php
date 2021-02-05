<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_see_orders()
    {
        $manager = factory(Manager::class)->create([
            'admin_id' => factory(Admin::class)->create(['type' => 'manager'])->id,
        ]);

        $this->actingAs($manager->admin, 'admin')->get('/order')

            ->assertStatus(200);
    }
}
