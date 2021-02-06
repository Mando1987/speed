<?php
namespace App\Http\Traits\Tests;

use App\Models\Admin;
use App\Models\Manager;

trait ActingAs
{
    private function actingAsManager()
    {
        $manager = factory(Manager::class)->create([
            'admin_id' => factory(Admin::class)->create(['type' => 'manager'])->id,
        ]);
        return $this->actingAs($manager->admin, 'admin');
    }
}
