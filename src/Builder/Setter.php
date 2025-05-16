<?php

namespace Amtgard\Traits\Builder;

use ReflectionClass;

trait Setter {

    use _Setter, _NameExtractor;
    public function __call($setCall, $arguments)
    {
        if (str_starts_with($setCall, "set")) {
            $name = $this->_extractName($setCall);
            $this->$name = $arguments[0];
            return;
        }
        throw new \Exception("Property {$name} does not exist in class" . get_class($this));
    }
}