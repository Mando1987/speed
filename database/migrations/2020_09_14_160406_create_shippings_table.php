<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     *  weight
     *  quantity
     *  price
     *  charge_on
     *  total_weight
     *  total_over_weight
     *  total_over_weight_price
     *  discount
     *  charge_price
     *  total_price
     *
     *
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedSmallInteger('quantity');
            $table->string('weight', 6);
            $table->string('total_weight', 6);
            $table->string('total_over_weight', 6);
            $table->string('price', 6);
            $table->string('total_over_weight_price', 6);
            $table->string('discount', 6);
            $table->string('charge_price', 6);
            $table->string('total_price', 6);
            $table->enum('charge_on', ['sender','reciver']);
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
