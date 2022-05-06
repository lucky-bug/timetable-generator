<?php

namespace Tests\Services\Generators;

use App\Services\Generators\SimplePopulationGenerator;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimplePopulationGeneratorTest extends TestCase
{
    private const EXAMPLE_POPULATION_SIZE = 10;

    private SimplePopulationGenerator $populationGenerator;

    protected function setUp(): void
    {
        $this->populationGenerator = new SimplePopulationGenerator();
    }

    public function testGenerate()
    {
        $population = $this->populationGenerator->generate(self::EXAMPLE_POPULATION_SIZE);

        self::assertEquals(self::EXAMPLE_POPULATION_SIZE, $population->getSize());
        self::assertCount(self::EXAMPLE_POPULATION_SIZE, $population->getAll());
    }
}
