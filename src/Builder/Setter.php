<?php

namespace Amtgard\Traits\Builder;

use ReflectionClass;

trait Setter {

    use _Setter, _NameExtractor;
    public function __call($setCall, $arguments)
    {
        if (str_starts_with($setCall, "set")) {
            $name = $this->_extractName($setCall);
            $value = $this->__handleCall($this, OnSet::class, $name, $arguments[0]);
            $this->$name = $value;
            return;
        }
        throw new \Exception("Property {$setCall} does not exist in class" . get_class($this));
    }
}