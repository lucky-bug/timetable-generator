<?php

namespace Tests;

use App\SimplePopulationGenerator;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimplePopulationGeneratorTest extends TestCase
{
    private SimplePopulationGenerator $populationGenerator;

    protected function setUp(): void
    {
        $this->populationGenerator = new SimplePopulationGenerator();
    }

    public function testGenerate()
    {
        $population = new Population();
        $population->add('0000');

        self::assertEquals($population, $this->populationGenerator->generate());
    }
}
