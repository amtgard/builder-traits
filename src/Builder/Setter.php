<?php

namespace Amtgard\Traits\Builder;

use ReflectionClass;

trait Setter {
    public function __call($name, $arguments)
    {
        if (property_exists($this, $name) && !method_exists($this, $name)) {
            $reflection = new ReflectionClass($this);
            $property = $reflection->getProperty($name);
            $property->setAccessible(true);
            $property->setValue($this, $arguments[0]);
            $property->setAccessible(false);
        } else {
            throw new \Exception("Property {$name} does not exist in class" . get_class($this));
        }
    }
}