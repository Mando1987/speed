<?php

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('fullname', 50);
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
        });
        $admin = Admin::create([
            'phone' => '01111213141',
            'email' => 'admin@admin.com',
            'user_name' => 'mando1987',
            'password' => bcrypt('123456'),
            'is_active' => 1,
            'type' => 'manager',
        ]);
        $admin->manager()->create(['fullname' => 'admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('managers');
    }
}
