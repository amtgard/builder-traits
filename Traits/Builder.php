<?php

namespace Traits;

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
          $this->instance->$name = $arguments[0];
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

  public function __set($name, $value)
  {
    if (property_exists($this, $name)) {
      $this->$name = $value;
    } else {
      throw new \Exception("Property {$name} does not exist");
    }
  }
}
