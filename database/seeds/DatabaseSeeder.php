<?php

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(OrderTableSeeder::class);

         $defaultAdmin = factory(Admin::class)->create(
            [
                'type' => 'manager',
                'user_name' => 'Mando1987',
                'phone' => '01270142656',
                'email' => 'admin@admin.com',
                'password' => bcrypt(123456),
                'is_active' => 1,
            ]
        );

        factory(Manager::class)->create([
            'admin_id' => $defaultAdmin->id,
            'fullname' =>'mando'
        ]);

        factory(Manager::class)->create([
            'admin_id' => factory(Admin::class)->create(['type' => 'manager'])->id,
        ]);
    }
}
