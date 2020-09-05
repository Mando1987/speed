<?php 

namespace App\Http\Traits;

use App\Models\Permission;
use App\Models\Role;

trait RoleTrait

{
    public function role()
    {
       return new Role();
    }
    public function getAllPermissions()
    {
        
        return Permission::where('type', currentAdminType())->get() ?? [];
       
    }

    public function getAllTags()
    {
      return config('permission.tags.' . currentAdminType()) ?? [];   
    }
    

}