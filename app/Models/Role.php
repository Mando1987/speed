<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    protected $hidden = ['pivot'];
    public $timestamps = true;

    /**
     * relation with admins is One To Many
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
    /**
     * relation with permissions is Many To Many
     * pivot table : permission_role
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->select('id', 'name');
    }

    /**
     * create new role with permissions
     */

    public function createNewRole(array $data)
    {
        optional($this->create(['name' => $data['name']]))->permissions()->attach($data['permissions']);
    }

    public function path()
    {
        return redirect()->route('role.index');
    }

    public function getAllRoles()
    {
        return $this->withCount('permissions', 'admins')->get() ?? [];
    }

}
