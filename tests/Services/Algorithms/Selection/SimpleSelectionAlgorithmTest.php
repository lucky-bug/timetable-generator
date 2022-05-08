<?php

namespace Tests\Services\Algorithms\Selection;

use App\Services\Algorithms\Selection\SimpleSelectionAlgorithm;
use Core\FitnessCalculatorInterface;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimpleSelectionAlgorithmTest extends TestCase
{
    private const EXAMPLE_TOTAL_SELECTION = 5;

    private SimpleSelectionAlgorithm $selectionAlgorithm;

    protected function setUp(): void
    {
        $mockedFitnessCalculator = $this->createMock(FitnessCalculatorInterface::class);
        $this->selectionAlgorithm = new SimpleSelectionAlgorithm(
            $mockedFitnessCalculator,
            self::EXAMPLE_TOTAL_SELECTION
        );
    }

    private function createPopulation(int $size): Population
    {
        $population = new Population();

        for ($i = 0; $i < $size; $i++) {
            $population->add('');
        }

        return $population;
    }

    public function testSelect()
    {
        for ($i = self::EXAMPLE_TOTAL_SELECTION + 1; $i < self::EXAMPLE_TOTAL_SELECTION * 2; $i++) {
            self::assertCount(
                self::EXAMPLE_TOTAL_SELECTION,
                $this->selectionAlgorithm->select($this->createPopulation($i))->getAll()
            );
        }
    }
}
