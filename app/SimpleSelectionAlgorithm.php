<?php

namespace App;

use Core\Population;
use Core\SelectionAlgorithmInterface;

class SimpleSelectionAlgorithm implements SelectionAlgorithmInterface
{
    public function select(Population $population): Population
    {
        return $population;
    }
}
