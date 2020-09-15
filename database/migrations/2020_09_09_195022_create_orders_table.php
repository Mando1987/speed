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
    public function up()
    {
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

        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->string('type', 100);
            $table->string('status', 100);
            $table->string('info', 200);
            $table->string('notes', 200);
            $table->tinyInteger('user_can_open_order')->size(1)->default(0);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('reciver_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('reciver_id')->references('id')->on('recivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
