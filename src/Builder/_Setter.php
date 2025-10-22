<?php

namespace Amtgard\Traits\Builder;

use ReflectionClass;

trait _Setter
{
    use _CallHandler;

    public function __set($name, $value) {
        if (property_exists($this, $name) && !method_exists($this, $name)) {
            $reflection = new ReflectionClass($this);
            $property = $reflection->getProperty($name);
            $property->setAccessible(true);
            $value = $this->__handleCall($this, OnSet::class, $name, $value);
            $property->setValue($this, $value);
            $property->setAccessible(false);

        }
    }
}