<?php

namespace Amtgard\Traits\Builder;

trait _Setter
{
    public function __set($name, $value) {
        if (property_exists($this, $name) && !method_exists($this, $name)) {
            $reflection = new ReflectionClass($this);
            $property = $reflection->getProperty($name);
            $property->setAccessible(true);
            $property->setValue($this, $value);
            $property->setAccessible(false);
        }
    }
}