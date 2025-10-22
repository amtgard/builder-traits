<?php

namespace Amtgard\Traits\Builder;

trait Getter {
    use _Getter, _NameExtractor;

    public function __call($getCall, $arguments) {
        if (str_starts_with($getCall, "get")) {
            $name = $this->_extractName($getCall);
            $value = $this->$name;
            $this->__handleCall($this, OnGet::class, $name, $value);
            return $this->$name;
        }
        throw new \Exception("Property {$getCall} does not exist in class" . get_class($this));
    }


}