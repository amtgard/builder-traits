<?php

namespace Amtgard\Traits\Builder;

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
        $this->instance = new $className();
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
