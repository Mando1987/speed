<?php

use App\Models\Delegate;
use Illuminate\Database\Seeder;

class DelegateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Delegate::class,5)->create();
    }
}
