<?php
namespace App\Http\Traits;

trait CallStaticClass
{
    private static $instance;
    public static function __callStatic($name, $arguments)
    {
        $concreateClassName = config(sprintf('bindClasses.%s.%s', __CLASS__ , request()->adminType));

        if ($concreateClassName && class_exists($concreateClassName)) {
            static::$instance = (null !== static::$instance) ? static::$instance : $concreateClassName;
            return static::$instance::$name(...$arguments);
        }
        return sprintf('concreate class for abstract [%s] not exists check file [%s]',
            __CLASS__, 'config\\bindClassess.php'
        );
    }
}