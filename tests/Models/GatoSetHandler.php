<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\OnSet;
use Amtgard\Traits\Builder\PostInit;
use Amtgard\Traits\Builder\Setter;

class GatoSetHandler
{
    use Builder, Setter;

    private $onSetField;
    private $aField;
    private $id;

    public function getOnSetField() {
        return $this->onSetField;
    }

    public function getAField() {
        return $this->aField;
    }

    #[OnSet]
    private function onSet($name, $value) {
        $this->onSetField = $value;
        return $value;
    }

    #[PostInit]
    private function postInit() {
        $this->id = md5(microtime());
    }
}