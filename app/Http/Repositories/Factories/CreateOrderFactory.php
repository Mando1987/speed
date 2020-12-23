<?php
namespace App\Http\Repositories\Factories;

use App\Http\Interfaces\BaseFactoryInterface;
use App\Http\Interfaces\CreateOrderRepositoryInterface;
use App\Http\Traits\FactoryTrait;

class CreateOrderFactory implements BaseFactoryInterface
{
    use FactoryTrait;
    /**
     * @var CreateOrderRepositoryInterface
     */
    private static $abstract = CreateOrderRepositoryInterface::class;
    /**
     * getInstance from concreate class
     *
     * @return \App\Http\Interfaces\CreateOrderRepositoryInterface
     */
    public static function getInstance() : CreateOrderRepositoryInterface
    {
       return static::buildConcreateClass(static::$abstract);
    }
}
