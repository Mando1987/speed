<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    
    public function langChange($language)
    {

        if (array_key_exists($language , config('languages'))){

            if (session()->has('lang') && !empty(session('lang'))){
                session()->forget('lang');
             }
             app()->setLocale($language);
             session(['lang' => $language]);
             return back();
            
        }
    }
}
