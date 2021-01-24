<?php

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Manager::class,1)->create([
            'admin_id' => factory(Admin::class)->create(['type' => 'manager'])->id
        ]);
    }
}
