<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Role;

class AdminFetchDataService extends BaseService
{
    const COLMUN = 'type';
    private $authintecatedAdmin; 
    private $adminModel; 
    private $adminHowEdit; 
    private $isParentSigular = true; 
   
    public function __construct()
    { 
        $this->adminModel = new Admin();
        $this->authintecatedAdmin = auth('admin')->user();
    }

    public function getSinglAdminData($id)
    {
        $this->adminHowEdit = $this->adminModel::findOrFail($id);

         return view('admin.edit', [
                'parents'         => $this->getAdminParent() ,
                'admin'           => $this->adminHowEdit ,
                'allRoles'        => $this->getAllRoles() , 
                'isParentSigular' => $this->isParentSigular 
         ]);
    }

    public function getAdminParent()
    {
        if($this->authintecatedAdmin->is_super == 1){

             $this->isParentSigular = false;
            return $this->adminModel::where(self::COLMUN, $this->authintecatedAdmin->type)->get();  
        } 
        return  $this->adminHowEdit->parent_id; 
    }

    public function getAllRoles()
    {
        return Role::where(self::COLMUN, $this->authintecatedAdmin->type)->get();
    }
 }
