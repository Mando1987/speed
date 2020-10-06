<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('governorate_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('national_id', 14)->unique();
            $table->string('address');
            $table->string('qualification',50)->nullable();
            $table->string('social_status', 8)->nullable();
            $table->string('image')->default('default.png');
            $table->string('national_image')->default('default.png');
            $table->timestamps();

            $table->foreign('governorate_id')->references('id')->on('governorates');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
        Schema::create('delegate_drives', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('delegate_id');
            $table->string('type', 15)->nullable();
            $table->string('color', 20)->nullable();
            $table->string('plate_number', 20)->unique()->nullable();
            $table->foreign('delegate_id')->references('id')->on('delegates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delegates');
    }
}
