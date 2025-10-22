<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Getter;
use Amtgard\Traits\Builder\PostInit;
use Amtgard\Traits\Builder\FalseFlagAttribute;

class PrivateGato
{
    use Builder, Getter;

    private $aField;
    private $bField;
    private $onSetField;

    private function __construct() { }

    #[FalseFlagAttribute]
    private function notAPostInit() {
        $this->aField = 'a';
    }

    #[PostInit]
    private function postInit() {
        $this->bField = 'b';
    }

}