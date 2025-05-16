<?php

namespace Amtgard\Traits\Builder;

trait Data
{
    use _Setter, _Getter, _NameExtractor;
    public function __call($xetCall, $arguments) {
        $name = $this->_extractName($xetCall);
        if (str_starts_with($xetCall, "set")) {
            $this->$name = $arguments[0];
            return null;
        } else if (str_starts_with($xetCall, "get")) {
            return $this->$name;
        }
    }
}