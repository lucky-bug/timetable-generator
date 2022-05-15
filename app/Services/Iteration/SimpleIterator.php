<?php

namespace App\Services\Iteration;

use Core\IterationControllerInterface;
use Core\IteratorInterface;
use Core\Population;
use Core\ReproductionMethodInterface;
use Core\SelectionMethodInterface;

class SimpleIterator implements IteratorInterface
{
    private int $iterationsCount;
    private ReproductionMethodInterface $reproductionMethod;
    private SelectionMethodInterface $selectionMethod;
    private IterationControllerInterface $iterationController;

    public function __construct(
        ReproductionMethodInterface $reproductionMethod,
        SelectionMethodInterface $selectionMethod,
        IterationControllerInterface $iterationController
    ) {
        $this->reset();
        $this->reproductionMethod = $reproductionMethod;
        $this->selectionMethod = $selectionMethod;
        $this->iterationController = $iterationController;
    }

    public function reset(): void
    {
        $this->iterationsCount = 0;
    }

    public function iterate(Population $initialPopulation): Population
    {
        $population = clone $initialPopulation;

        while ($this->iterationController->shouldContinue($population)) {
            $population = $this->reproductionMethod->reproduce(
                $this->selectionMethod->select($population)
            );

            $this->iterationsCount++;
        }

        return $population;
    }

    public function getTotalIterations(): int
    {
        return $this->iterationsCount;
    }
}
