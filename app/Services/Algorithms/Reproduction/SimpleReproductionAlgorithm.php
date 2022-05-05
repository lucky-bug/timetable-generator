<?php

namespace App\Services\Algorithms\Reproduction;

use Core\Population;
use Core\ReproductionAlgorithmInterface;

class SimpleReproductionAlgorithm implements ReproductionAlgorithmInterface
{
    public function reproduce(Population $population): Population
    {
        return $population;
    }
}
