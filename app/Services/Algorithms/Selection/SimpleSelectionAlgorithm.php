<?php

namespace App\Services\Algorithms\Selection;

use Core\FitnessCalculatorInterface;
use Core\Population;
use Core\SelectionAlgorithmInterface;

class SimpleSelectionAlgorithm implements SelectionAlgorithmInterface
{
    private FitnessCalculatorInterface $fitnessCalculator;
    private int $totalSelection;

    public function __construct(
        FitnessCalculatorInterface $fitnessCalculator,
        int $totalSelection
    ) {
        $this->fitnessCalculator = $fitnessCalculator;
        $this->totalSelection = $totalSelection;
    }

    public function select(Population $population): Population
    {
        $newPopulation = new Population();

        $genesList = $population->getAll();

        usort(
            $genesList,
            function (string $firstGenes, string $secondGenes) {
                return $this->fitnessCalculator->calculate($firstGenes) < $this->fitnessCalculator->calculate($secondGenes);
            }
        );

        $newPopulation->setAll(
            array_slice(
                $genesList,
                0,
                $this->totalSelection
            )
        );

        return $newPopulation;
    }
}
