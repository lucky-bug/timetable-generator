<?php

namespace App\Services\Generators;

use Core\Population;
use Core\PopulationGeneratorInterface;

class SimplePopulationGenerator implements PopulationGeneratorInterface
{
    public function generate(int $size): Population
    {
        $population = new Population();

        for ($i = 0; $i < $size; $i++) {
            $population->add('0000');
        }

        return $population;
    }
}
