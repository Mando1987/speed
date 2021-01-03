<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 11)->unique();
            $table->string('other_phone', 11)->nullable();
            $table->string('email')->unique();
            $table->string('user_name')->unique();
            $table->string('password');
            $table->tinyInteger('is_active')->size(1)->default(1);
            $table->enum('type', ['manager', 'customer', 'delegate']);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
