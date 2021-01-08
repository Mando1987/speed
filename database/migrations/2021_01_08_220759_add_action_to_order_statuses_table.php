<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActionToOrderStatusesTable extends Migration
{

    public function up()
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->string('action')->nullable();
        });
    }

    public function down()
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->dropColumn('action');
        });
    }
}
