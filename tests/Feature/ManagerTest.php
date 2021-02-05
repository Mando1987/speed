<?php

namespace Tests\Feature;

use App\Http\Traits\Tests\ActingAs;
use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    use RefreshDatabase, ActingAs;

    public function test_can_see_managers()
    {
        $this->actingAsManager()->get('/managers')

            ->assertStatus(200);
    }

    public function test_can_add_new_manager()
    {
        $managerData = factory(Manager::class)->make()->toArray();
        $password = 123456;
        $this->actingAsManager()->post('/managers',
            [
                'password' => $password,
                'password_confirmation' => $password,
                'admin' => array_merge(factory(Admin::class)->make()->toArray()),
                'manager' => $managerData,
            ]
        );

        $this->assertDatabaseHas('managers', $managerData);

    }
    public function test_can_update_manager()
    {
        $admin = factory(Admin::class)->create(['type' => 'manager']);
        $manager = factory(Manager::class)->create([
            'admin_id' => $admin->id,
        ]);

        $managerData = factory(Manager::class)->make()->toArray();
        $adminData = factory(Admin::class)->make()->toArray();
        $this->actingAsManager()->put('/managers/' . $manager->id,
            [
                'managerId' => $manager->id,
                'adminId' => $manager->admin->id,
                'admin' => $adminData,
                'manager' => $managerData,
            ]
        );

        $this->assertDatabaseHas('managers', array_merge($managerData, ['id' => $manager->id]));
        $this->assertDatabaseHas('admins', array_merge($adminData, ['id' => $admin->id]));
    }

    public function test_can_delete_manager()
    {
        $admin = factory(Admin::class)->create(['type' => 'manager']);
        $manager = factory(Manager::class)->create([
            'admin_id' => $admin->id,
        ]);
        $this->actingAsManager()->delete('/managers/'. $manager->id);
        $this->assertDatabaseMissing('managers', ['id' => $manager->id,'fullname' => $manager->fullname]);
        $this->assertDatabaseMissing('admins', ['id' => $admin->id]);

    }
}
