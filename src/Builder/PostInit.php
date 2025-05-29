<?php

namespace Amtgard\Traits\Builder;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class PostInit
{
    public function __construct()
    {
    }
}