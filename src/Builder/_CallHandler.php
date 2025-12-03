<?php

namespace Amtgard\Traits\Builder;

use ReflectionClass;

trait _CallHandler
{
    private function __handleCall($self, $traitClass, $name, $value) {
        $class = new ReflectionClass($self);
        foreach ($class->getMethods(\ReflectionMethod::IS_PRIVATE | \ReflectionMethod::IS_PROTECTED) as $reflectionMethod) {
            $attributes = $reflectionMethod->getAttributes($traitClass);
            if (count($attributes) == 1) {
                $reflectionMethod->setAccessible(true);
                $value = $reflectionMethod->invoke($self, $name, $value);
                $reflectionMethod->setAccessible(false);
                return $value;
            }
        }
        return $value;
    }
}