<?php

namespace App\Services;

use Core\ConvergenceCheckerInterface;
use Core\Population;

class SimpleConvergenceChecker implements ConvergenceCheckerInterface
{
    public function check(Population $population): bool
    {
        return true;
    }
}
