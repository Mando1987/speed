<?php 

namespace App\Http\Traits;

trait Notify

{
   
   public static function addedSuccessfuly()
   {
      return session()->flash('notify' , ['icon' => 'success' ,'title' => trans('site.added')]) ;
   }
   public static function editedSuccessfuly()
   {
      return session()->flash('notify' , ['icon' => 'success' ,'title' => trans('site.edited')]) ;
   }
   public static function deletedSuccessfuly()
   {
      return session()->flash('notify' , ['icon' => 'success' ,'title' => trans('site.deleted')]) ;
   }

}