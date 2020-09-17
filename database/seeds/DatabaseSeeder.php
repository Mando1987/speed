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
         $this->call(ShippingTableSeeder::class);
        // AdminProfile::truncate();
        // Admin::truncate();
        // Role::truncate();
        // Company::truncate();
        // Permission::truncate();
        //factory(Profile::class, 300)->create();

        // factory(Admin::class, 1)->create(

        //  [
        //  'name'       => 'admin',
        //  'password'   => bcrypt('123456'),
        //  'fullname'   => 'admin',
        //  'active'     => 1,
        //  'type'       => 'admin',
        //  'role_id'    => 1,
        //  ]

        // );
        // factory(Permission::class, 1)->create();
    }
}
