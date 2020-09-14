<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('reciver_id');
            $table->unsignedBigInteger('customer_id');

            $table->enum('order_type', [
                'same_day_delivery',
                'document_delivery_service',
                'send_transmitters_service',
                'correspondents_service',
                'packaging_service',
                'international_shipping',
                'governorates_delivery',
            ]);

            $table->foreign('reciver_id')->references('id')->on('recivers');
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->timestamps();
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
