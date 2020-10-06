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
            $table->unsignedBigInteger('governorate_id')->default(1);
            $table->unsignedBigInteger('city_id')->default(1);
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('fullname', 50);
            $table->string('phone', 11)->unique();
            $table->string('other_phone', 11)->nullable();
            $table->string('company_name', 100)->nullable();
            $table->string('facebook_page')->nullable();
            $table->string('image')->default('default.png');
            $table->enum('contract_type',['daily','monthly'])->default('daily');
            $table->string('activity', 100)->nullable();

            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
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
    }
}
