<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * name => super_admin , customer , user , any thing 
         */
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['admin','manager'])->default('admin');
            $table->timestamps();
        });

        /**
         * name => admin_edit , user_create
         * tag  => admin      , user
         */
        Schema::create('permissions', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->enum('type',['admin','manager'])->default('admin');
            $table->string('tag');
            
        });

        Schema::create('permission_role', function (Blueprint $table) {

            $table->primary(['role_id' , 'permission_id']);
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        /**
         * roles table
         *  name =>super admin 
         */
        $allPermissions = config('permission.all');
        $adminRole = new Role(['name' => 'admin' , 'type' =>'admin']);
        $adminRole->save();
        foreach ($allPermissions['admin'] as $tag => $permissions) {

            foreach ($permissions as $permissionName) {

                $adminRole->permissions()->create([
                    'type' => 'admin' ,
                    'tag'  => $tag ,
                    'name' => $tag . '_' . $permissionName
                ]);
            }
        }
        $managerRole = new Role(['name' => 'manager' , 'type' => 'manager']);
        $managerRole->save();
        foreach ($allPermissions['manager'] as $tag => $permissions) {

            foreach ($permissions as $permissionName) {

                $managerRole->permissions()->create([
                    'type' => 'manager' ,
                    'tag'  => $tag ,
                    'name' => $tag . '_' . $permissionName
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {  
        Schema::disableForeignKeyConstraints();    
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::enableForeignKeyConstraints();
    }
}
