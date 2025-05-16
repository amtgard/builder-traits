<?php

namespace Amtgard\Traits\Builder;

trait _Getter
{
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        } else {
            throw new \Exception("Property {$name} does not exist");
        }
    }
}