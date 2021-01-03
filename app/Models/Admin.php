<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = ['password' , 'remember_token' , 'email_verified_at' , 'updated_at' , 'pivot','api_token'];

    public function role()
    {
       return $this->belongsTo(Role::class)->select(['id','name']);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
    public function delegate()
    {
        return $this->hasOne(Delegate::class);
    }
    public function viewSetting()
    {
        return $this->hasOne(ViewSetting::class);
    }


   //  public function profile()
   //  {
   //     return $this->morphOne(Profile::class , 'profilable')->withDefault(function($profile){

   //        $profile->email   = 'not found';
   //        $profile->address = 'not found';
   //        $profile->phone   = 'not found';
   //     });
   //  }

   //  public function logs()
   //  {
   //      return $this->hasMany(Log::class);
   //  }

   //  public function getActive()
   //  {
   //     return $this->is_active ? trans('site.active') : trans('site.notactive');
   //  }


    /**
     *  check where admin has permission like this admin_create , role_update
     * if admin has permission to create this will have to access store permission
     * if admin has permission to edit this will have to access update permission
     */
    public function hasPermission($abilitiy)
    {
      //   $abilitiyStore          = Str::endsWith($abilitiy, 'store');
      //   $abilitiyChangeActive   = Str::endsWith($abilitiy, 'changeActive');
      //   $abilitiyUpdate         = Str::endsWith($abilitiy, 'update');

      //   if($abilitiyStore){

      //      $abilitiy = Str::before($abilitiy, 'store') . 'create';
      //   }
      //   if($abilitiyUpdate){

      //      $abilitiy = Str::before($abilitiy, 'update') . 'edit';
      //   }
      //   // admin can edit ?? ok he can change admin active
      //   if($abilitiyChangeActive){

      //      $abilitiy = Str::before($abilitiy, 'changeActive') . 'edit';
      //   }

      // return $this->role->permissions->pluck('name')->unique()->contains($abilitiy);

      return true;

    }

    public function getPassword()
    {
       return $this->password;
    }






}
