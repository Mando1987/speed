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
            $table->string('phone', 11)->unique();
            $table->string('other_phone', 11)->nullable();
            $table->string('email')->unique();
            $table->string('user_name')->unique();
            $table->string('password');
            $table->tinyInteger('is_active')->size(1)->default(1);
            $table->enum('type', ['manager', 'customer', 'delegate']);
            $table->timestamps();
        });

        Admin::create(

                [
                    'fullname'   => 'admin',
                    'phone'      => '01111213141',
                    'email'      => 'admin@admin.com',
                    'user_name'  => 'mando1987',
                    'password'   => bcrypt('123456'),
                    'is_active'  => 1,
                    'type'       => 'manager',
                ]
        );
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
