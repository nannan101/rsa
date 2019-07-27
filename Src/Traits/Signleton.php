<?php

namespace Src\Traits;

trait Signleton
{
    static private $instance;

    static public function getInstance()
    {
        if (is_null(static::$instance)) {
            $class = new \ReflectionClass(get_called_class());
            static::$instance = $class->newInstanceWithoutConstructor();
            $constructor = $class->getConstructor();
            $constructor->setAccessible(true);
            $default = [];
            foreach ($constructor->getParameters() as $parameter) {
                $default[] = $parameter->getDefaultValue();
            }
            $constructor->invokeArgs(static::$instance, array_replace_recursive($default, func_get_args()));
        }
        
        return static::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}