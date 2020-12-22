<?php
namespace App\Http\Traits;

trait calledMethodNotExists
{
    public function __call($name , $args)
    {
       return sprintf('called method [%s] not exists in class [%s]', $name , __CLASS__);
    }
}