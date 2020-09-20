<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('other_phone', 11)->unique()->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('facebook_page')->nullable();
            // $table->string('notes')->nullable();
            $table->string('image')->default('default.png');
            $table->enum('contract_type',['daily','monthly'])->default('daily');

            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });

        Schema::create('customer_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('address');
            $table->string('special_marque', 100)->nullable();
            $table->string('house_number', 10)->nullable();
            $table->string('door_number', 10)->nullable();
            $table->string('shaka_number', 10)->nullable();
            $table->string('activity', 100)->nullable();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('customer_info');
    }
}
