<?php
namespace App\Http\Traits;

trait FactoryTrait
{
    /**
     * build Concreate Class for any abstract interface
     *
     * @param  $abstract [interface]
     *
     * @return object|string
     */
    private static function buildConcreateClass($abstract)
    {
        $concreateClass = config(sprintf('factory_classes.%s.%s', $abstract, request()->adminType));
        if ($concreateClass && class_exists($concreateClass)) {
            return (new $concreateClass);
        }
        return sprintf('concreate class for abstract [%s] not exists check file [%s]',
            $abstract, 'config\\factory_classes.php'
        );
    }
}
