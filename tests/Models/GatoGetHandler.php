<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Getter;
use Amtgard\Traits\Builder\OnGet;
use Amtgard\Traits\Builder\PostInit;

class GatoGetHandler
{
    use Builder, Getter;

    private $onSetField;
    private $onGetField;
    private $aField;

    private $id;

    #[OnGet]
    private function onGet($name, $value) {
        $this->onGetField = "side-effect";
        return $value;
    }

    #[PostInit]
    private function postInit() {
        $this->id = md5(microtime());
    }
}