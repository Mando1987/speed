<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(OrderTableSeeder::class);
        $this->call(ManagerTableSeeder::class);
        $this->call(DelegateTableSeeder::class);
    }
}
