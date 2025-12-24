<?php

namespace Amtgard\Traits\Builder;

use Optional\Optional;
use ReflectionClass;

trait Builder
{
    public static function builder()
    {
        $className = static::class;

        return new class($className) {
            private $instance;

            public function __construct($className)
            {
                $class = new ReflectionClass($className);
                $constructor = $class->getConstructor();
                $self = $this;
                Optional::ofNullable($constructor)
                    ->map(function() use ($class, $constructor, $self) {
                        $constructor->setAccessible(true);
                        $self->instance = $class->newInstanceWithoutConstructor();
                        $constructor->invoke($self->instance);
                        $this->__callPreInit($self->instance);
                        return $self->instance;
                    })
                    ->orElseGet(function() use ($className, $self) {
                        $self->instance = new $className();
                        $this->__callPreInit($self->instance);
                        return $self->instance;
                    });
            }

            private function __callPreInit($instance) {
                $class = new ReflectionClass($instance);
                foreach ($class->getMethods(\ReflectionMethod::IS_PRIVATE | \ReflectionMethod::IS_PROTECTED) as $reflectionMethod) {
                    $attributes =  $reflectionMethod->getAttributes(PreInit::class);
                    if (count($attributes) == 1) {
                        $reflectionMethod->setAccessible(true);
                        $reflectionMethod->invoke($instance);
                        $reflectionMethod->setAccessible(false);
                    }
                }
            }

            public function __call($name, $arguments)
            {
                if (property_exists($this->instance, $name)) {
                    $reflection = new ReflectionClass($this->instance);
                    $property = $reflection->getProperty($name);
                    $property->setAccessible(true);
                    $value = $this->__handleCall($this->instance, OnSet::class, $name, $arguments[0]);
                    $property->setValue($this->instance, $value);
                    $property->setAccessible(false);
                } else {
                    throw new \Exception("Property {$name} does not exist in class" . get_class($this->instance));
                }
                return $this;
            }

            private function __handleCall($self, $traitClass, $name, $value) {
                $class = new ReflectionClass($self);
                $methods = $class->getMethods(\ReflectionMethod::IS_PRIVATE | \ReflectionMethod::IS_PROTECTED);
                foreach ($methods as $reflectionMethod) {
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

            public function build()
            {
                $class = new ReflectionClass($this->instance);
                foreach ($class->getMethods(\ReflectionMethod::IS_PRIVATE | \ReflectionMethod::IS_PROTECTED) as $reflectionMethod) {
                    $attributes =  $reflectionMethod->getAttributes(PostInit::class);
                    if (count($attributes) == 1) {
                        $reflectionMethod->setAccessible(true);
                        $reflectionMethod->invoke($this->instance);
                        $reflectionMethod->setAccessible(false);
                    }
                }
                return $this->instance;
            }
        };
    }
}
