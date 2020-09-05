<?php

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernoratesTable extends Migration
{

    public function up()
    {
        Schema::create('governorates', function (Blueprint $table) {
            $table->id();
            $table->string('governorate_name', 30);
            $table->string('governorate_name_en', 30);
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name', 30);
            $table->string('city_name_en', 30);
            $table->unsignedBigInteger('governorate_id');
            $table->foreign('governorate_id')->references('id')->on('governorates');
        });

        Governorate::insert(config('governorates'));
        City::insert(config('cities'));
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('governorates');
        Schema::dropIfExists('cities');
        Schema::enableForeignKeyConstraints();
    }
}
