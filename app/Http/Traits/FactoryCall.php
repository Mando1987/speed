<?php
namespace App\Http\Traits;

trait FactoryCall
{
    private $abstract;
    /**
     *
     * @param [type] $abstract interface
     * @return void
     */
    public function getInstance($abstract)
    {
       $this->abstract = $abstract;
    }
    public function __call($name, $arguments)
    {
        $concreateClass = config(sprintf('factory_classes.%s.%s', $this->abstract, request()->adminType));

        if ($concreateClass && class_exists($concreateClass)) {
            return (new $concreateClass)->$name(...$arguments);
        }
        return sprintf('concreate class for abstract [%s] not exists check file [%s]',
            $this->abstract, 'config\\factory_classes.php'
        );
    }
}