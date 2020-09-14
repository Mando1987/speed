<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recivers', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('city_id');
            $table->string('phone', 11)->unique();
            $table->string('fullname', 50);
            $table->string('other_phone', 11)->unique()->nullable();
            $table->string('address');
            $table->string('special_marque', 100);
            $table->string('house_number', 10);
            $table->string('door_number', 10);
            $table->string('shaka_number', 10);
            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recivers');
    }
}
