<?php
namespace App\Http\Interfaces;

interface BaseFactoryInterface
{
    /**
     * getInstance from concreate class
     *
     * @return \App\Http\Interfaces\*any_interface*
     */
    public static function getInstance();
}

