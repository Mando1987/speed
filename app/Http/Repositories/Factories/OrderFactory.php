<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Traits\FactoryTrait;

class OrderFactory implements BaseFactoryInterface
{
    use FactoryTrait;
    /**
     * @var OrderRepositoryInterface
     */
    private static $abstract = OrderRepositoryInterface::class;
    /**
     * getInstance from concreate class
     *
     * @return \App\Http\Interfaces\OrderRepositoryInterface
     */
    public static function getInstance() : OrderRepositoryInterface
    {
       return static::buildConcreateClass(static::$abstract);
    }
}
