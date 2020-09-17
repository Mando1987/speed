<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * customers table

        id
        name
        phone
        email
        type
        user_name
        password
        is_active

        city
        street
        special_marque
        house_number
        floor_number
        Block_number
        Apartment_number
        notes
     *
     *
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('user_name', 50)->unique();
            $table->string('phone', 11)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('is_active')->size(1)->default(0);
            $table->enum('type',['manager','customer','mandoob']);
            $table->timestamps();
        });

        Admin::create([
            'fullname'   => 'admin' ,
            'user_name'  => 'admin' ,
            'phone'      => '54823954' ,
            'email'      => 'admin@admin.com' ,
            'password'   => bcrypt('123456') ,
            'is_active'  => 1 ,
            'type'       => 'manager' ,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
