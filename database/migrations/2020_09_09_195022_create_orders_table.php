<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /*
    * type
    * status
    * info
    * notes
    * user_can_open_order
    * store in shippings table
    * weight
    * quantity
    * price
    * charge_on
    * total_weight
    * total_over_weight
    * total_over_weight_price
    * discount
    * charge_price
    * total_price
    */
    /**
             * type in : ['same_day_delivery',
                'document_delivery_service',
                'send_transmitters_service',
                'correspondents_service',
                'packaging_service',
                'international_shipping',
                'governorates_delivery',]
        */
        // status in : ['phone_from_customer','customer_store_in_company']
    public function up()
    {
        Schema::create('senders', function (Blueprint $table) {
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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->string('type', 100);
            $table->string('status', 100);
            $table->string('info', 200);
            $table->string('notes', 200);
            $table->tinyInteger('user_can_open_order')->size(1)->default(0);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('reciver_id');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('senders');
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
            $table->string('total_over_weight_price', 6);
            $table->string('discount', 6);
            $table->string('charge_price', 6);
            $table->string('total_price', 6);
            $table->enum('charge_on', ['sender','reciver']);
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('shippings');
        Schema::dropIfExists('senders');
    }
}
