<?php

namespace App\Services;

use Core\IterationBreakerInterface;
use Core\Population;

class SimpleIterationBreaker implements IterationBreakerInterface
{
    public function check(Population $population): bool
    {
        return true;
    }
}
