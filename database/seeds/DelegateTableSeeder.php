<?php

use App\Models\Delegate;
use Illuminate\Database\Seeder;

class DelegateTableSeeder extends Seeder
{
    public function run()
    {
        factory(Delegate::class,5)->create();
    }
}
