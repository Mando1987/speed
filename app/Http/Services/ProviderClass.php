<?php
namespace App\Http\Services;

class ProviderClass
{
    private static $concreateClassName;
    private static $abstract;
    private static $instance;

    /**
     * register abinding abstract and get concreate class
     * @param [type] $abstract
     * @return object
     * after return instance from $abstract interface
     */
    public static function bind($abstract): object
    {
        static::$abstract = $abstract;
        static::setConcreateClass($abstract);
        if (static::$concreateClassName) {
            static::$instance = (null !== static::$instance) ? static::$instance : new static::$concreateClassName;
            return static::$instance;
        }
        return new self;
    }

    private static function setConcreateClass($abstract): void
    {
        $adminType = request()->adminType;
        $concreateClassName = config("bindClasses.{$abstract}.{$adminType}");
        if ($concreateClassName && class_exists($concreateClassName)) {
            static::$concreateClassName = $concreateClassName;
        }
    }
    public function __call($methodName, $arguments)
    {
        return sprintf('concreate class for abstract [%s] not exists check file [%s]',
            static::$abstract, 'config\\bindClassess.php'
        );
    }
}
