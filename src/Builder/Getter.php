<?php

namespace Amtgard\Traits\Builder;

trait Getter {
    use _Getter, _NameExtractor;

    public function __call($getCall, $arguments) {
        if (str_starts_with($getCall, "get")) {
            $name = $this->_extractName($getCall);
            return $this->$name;
        }
        throw new \Exception("Property {$name} does not exist in class" . get_class($this));
    }


}