<?php 

namespace App\Http\Traits;

use App\Models\Admin;
use App\Models\Role;

trait AdminTrait
{
    protected $admin;
    protected $role;

    public function __construct(Role $role , Admin $admin){

        $this->admin = $admin;
        $this->role  = $role;

    }
     
    public function path()
    {
       return redirect()->route('admin.index');
    }
    
    public function viewDashbord()
    {
      if (currentAdminType() == 'manager')
             return view('manager.dashboard.index');
             
      return view('admin.dashboard.index');
    }

    public function viewAdminIndex()
    {
      //  $admins = $this->admin::where('type' ,currentAdminType())->where('parent_id' ,currentAdminId())->paginate(12);
       $admins = $this->admin::paginate(12);
      if (currentAdminType() == 'manager')
             return view('manager.index' , ['admins' => $admins]);
             
      return view('admin.index' , ['admins' => $admins]);
    }
    

    public function getAllRoles()
    {
       return $this->role::where('type' , currentAdminType())->get() ?? [];
    }  
    public function getAllAdmins()
    {
       return $this->admin::where('type' , currentAdminType())->get() ?? [];
    }  
}
