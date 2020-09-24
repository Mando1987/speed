<?php

use Illuminate\Support\Facades\Route;
/**
 * generate breadcrumb url automatic
 * get routeName and check if exist in sidebar file languages
 * check if it not equal dashboard.index
 * if like admin.create explode this and get parenet url and
 */

if(!function_exists('breadcrumb') ){

    function breadcrumb()
    {

        $routeName = Route::currentRouteName();
        $routeLang = 'sidebar.' . currentAdminType();

        $breadcrumbUrl[] = [ 'route' =>route('dashboard.index') ,'class'=> 'active' , 'lang' => trans($routeLang .'.dashboard.index')];

        // dd($routeLang);

        if (array_key_exists($routeName , trans('sidebar' ))):

            if($routeName != 'dashboard.index'):

                    list($parent , $child) = explode('.' , $routeName);
                    $parent .='.index';

                    if($child != 'index'):

                        $breadcrumbUrl[] = ['route' => route($parent) , 'class'=> 'active' ,'lang' => trans($routeLang .'.' .  $parent)];
                    endif;

                    $breadcrumbUrl[] = ['route' => '' , 'class'=> '' ,'lang' => trans($routeLang .'.' . $routeName)];
            endif;
        else:
            $breadcrumbUrl[] = ['route' => '' , 'class'=> '' ,'lang' => trans($routeLang .'.' . $routeName)];
        endif;
        return $breadcrumbUrl;
    }
}
/**
 * get active breadcrumbName
 */
if(!function_exists('breadcrumbName') ){

    function breadcrumbName()

    {
      return (trans('sidebar.' . currentAdminType() .'.' . Route::currentRouteName()));
    }
}

if(!function_exists('currentRouteName') ){

    function currentRouteName()
    {
       return str_replace('.' , '_' , Route::currentRouteName());
    }
}

if(!function_exists('currentAdmin') ){

    function currentAdmin()
    {
       return auth('admin')->user();
    }
}

if(!function_exists('currentAdminId') ){

    function currentAdminId()
    {
       return auth('admin')->id();
    }
}

if(!function_exists('currentAdminType') ){

    function currentAdminType()
    {
       return currentAdmin()->type;
    }
}




if(!function_exists('adminName') ){

    function adminName()

    {
      return auth('admin')->user()->fullname;
    }
}
if(!function_exists('adminIsManager') ){

    function adminIsManager()

    {
      return auth('admin')->user()->type == 'manager';
    }
}

if(!function_exists('siteTitle') ){

    function siteTitle()

    {
        $routeName = Route::currentRouteName();
        if (array_key_exists($routeName , trans('sidebar')))

        {
            return trans('sidebar.' . $routeName);
        }
        return 'Alpha';
    }
}


if(!function_exists('defaultLangDirection') ){

    function defaultLangDirection()
    {
        return config('languages.'. app()->getLocale())['dir'];
    }
}
if(!function_exists('defaultLangAbbr') ){

    function defaultLangAbbr()
    {
        return config('languages.'. app()->getLocale())['abbr'];
    }
}
if(!function_exists('defaultLangFlag') ){

    function defaultLangFlag()
    {
        return config('languages.'. app()->getLocale())['flag'];
    }
}

