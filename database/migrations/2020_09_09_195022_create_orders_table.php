<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('recivers', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('phone', 11)->unique();
            $table->string('fullname', 50);
            $table->string('other_phone', 11)->unique()->nullable();
            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->string('type', 100);
            $table->string('status', 100);
            $table->string('info', 200);
            $table->string('notes', 200)->nullable();
            $table->tinyInteger('user_can_open_order')->size(1)->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('reciver_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('reciver_id')->references('id')->on('recivers');
        });
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedSmallInteger('quantity');
            $table->string('weight', 6);
            $table->string('total_weight', 6);
            $table->string('total_over_weight', 6);
            $table->string('price', 6);
            $table->string('customer_price', 6);
            $table->string('total_over_weight_price', 6);
            $table->string('discount', 6);
            $table->string('charge_price', 6);
            $table->string('total_price', 6);
            $table->string('order_num', 6)->unique();
            $table->enum('charge_on', ['sender','reciver']);
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }


    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('recivers');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('shippings');
        Schema::enableForeignKeyConstraints();
    }
}
