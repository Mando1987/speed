<?php

use App\Models\Sender;
use Illuminate\Database\Seeder;

class SenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sender::class,1)->create();
    }
}
