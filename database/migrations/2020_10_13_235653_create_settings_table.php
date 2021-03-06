<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->json('data');
        });

        $setting = new Setting;
        $setting->event = 'default_charge_price';
        $setting->data = [
            'send_weight' => 2,
            'send_price' => 35,
            'weight_addtion' => 1,
            'price_addtion' => 5,
        ];
        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
