<?php

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Company;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrderTableSeeder::class);
    }
}
