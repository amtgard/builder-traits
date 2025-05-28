<?php

namespace Amtgard\Traits\Builder;

use Optional\Optional;
use ReflectionClass;
use function PHPUnit\Framework\isNull;

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
                    $constructor->invoke($self->instance, 1);
                    return $self->instance;
                })
                ->orElseGet(function() use ($className, $self) {
                    $self->instance = new $className();
                    return $self->instance;
                });
        }

      public function __call($name, $arguments)
      {
        if (property_exists($this->instance, $name)) {
            $reflection = new ReflectionClass($this->instance);
            $property = $reflection->getProperty($name);
            $property->setAccessible(true);
            $property->setValue($this->instance, $arguments[0]);
            $property->setAccessible(false);
        } else {
          throw new \Exception("Property {$name} does not exist in class" . get_class($this->instance));
        }
        return $this;
      }

      public function build()
      {
        return $this->instance;
      }
    };
  }
}
