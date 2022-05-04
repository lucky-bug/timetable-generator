<?php

namespace App;

use Core\Population;
use Core\PopulationGeneratorInterface;

class SimplePopulationGenerator implements PopulationGeneratorInterface
{
    public function generate(): Population
    {
        $population = new Population();
        $population->add('0000');

        return $population;
    }
}
