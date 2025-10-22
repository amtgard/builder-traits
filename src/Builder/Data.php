<?php

namespace Amtgard\Traits\Builder;

trait Data
{
    use _Setter, _Getter, _NameExtractor, _CallHandler;
    public function __call($xetCall, $arguments) {
        $name = $this->_extractName($xetCall);
        if (str_starts_with($xetCall, "set")) {
            $this->$name = $this->__handleCall($this, OnSet::class, $name, $arguments[0]);
            return null;
        } else if (str_starts_with($xetCall, "get")) {
            $this->__handleCall($this, OnGet::class, $name, $this->$name);
            return $this->$name;
        }
        return null;
    }
}