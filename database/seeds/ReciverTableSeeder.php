<?php

use App\Models\Reciver;
use Illuminate\Database\Seeder;

class ReciverTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Reciver::class,1)->create();
    }
}
