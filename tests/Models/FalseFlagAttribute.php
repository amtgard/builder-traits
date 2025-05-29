<?php

namespace Amtgard\Traits\Builder;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class FalseFlagAttribute
{
    public function __construct() {}
}