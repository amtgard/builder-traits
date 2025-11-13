<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Data;
use Amtgard\Traits\Builder\OnGet;
use Amtgard\Traits\Builder\OnSet;
use Amtgard\Traits\Builder\PostInit;

class GatoDataHandler
{
    use Builder, Data;

    private $onSetField;
    private $onGetField;
    private $aField;

    private $id;
    private $preId;

    #[OnSet]
    private function onSet($name, $value) {
        $this->onSetField = $value;
        return $value;
    }

    #[OnGet]
    private function onGet($name, $value) {
        $this->onGetField = "side-effect";
        return $value;
    }

    #[PostInit]
    private function postInit() {
        $this->id = md5(microtime());
    }

    #[PreInit]
    private function preInit() {
        $this->preId = md5(microtime());
    }
}