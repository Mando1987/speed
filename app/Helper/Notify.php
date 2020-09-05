<?php 

if(!function_exists('notify')){

    function notify($icon = 'success' , $title = '')
    {
       return session()->flash('notify' , ['icon' => $icon ,'title' => trans('site.' . $title)]) ;
    }
}

################################################################
