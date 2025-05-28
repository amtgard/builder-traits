<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Getter;

class PrivateGato
{
    use Builder, Getter;

    private $aField;
    private $bField;

    private function __construct() { }
}