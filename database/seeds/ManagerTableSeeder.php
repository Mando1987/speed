<?php

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    public function run()
    {
        factory(Manager::class)->create([
            'admin_id' => factory(Admin::class)->create(['type' => 'manager'])->id
        ]);
    }
}
