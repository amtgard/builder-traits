<?php

namespace Amtgard\Traits\Builder;

trait _NameExtractor {
    public function _extractName($xet) {
        return lcfirst(substr($xet, 3));
    }
}