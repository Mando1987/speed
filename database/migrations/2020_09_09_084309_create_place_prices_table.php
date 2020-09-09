<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_prices', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('city_id')->unique();
            $table->string('send_weight',6)->default(0);
            $table->decimal('send_price',6,2)->default(0);
            $table->string('weight_addtion',6)->default(0);
            $table->decimal('price_addtion',6,2)->default(0);
            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_prices');
    }
}
