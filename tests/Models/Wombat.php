<?php

namespace Models;

use Amtgard\Traits\Builder\Builder;
use Amtgard\Traits\Builder\Setter;

class Wombat
{
    use Builder;
    use Setter;

    private $age;

    public function getAge() {
        return $this->age;
    }
}