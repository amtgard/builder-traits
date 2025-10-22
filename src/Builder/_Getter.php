<?php

namespace Amtgard\Traits\Builder;

trait _Getter
{
    use _CallHandler;

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            $value = $this->$name;
            $this->__handleCall($this, OnGet::class, $name, $value);
            return $this->$name;
        } else {
            throw new \Exception("Property {$name} does not exist");
        }
    }
}