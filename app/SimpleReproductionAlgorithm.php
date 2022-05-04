<?php

namespace App;

use Core\Population;
use Core\ReproductionAlgorithmInterface;

class SimpleReproductionAlgorithm implements ReproductionAlgorithmInterface
{
    public function reproduce(Population $population): Population
    {
        return $population;
    }
}
