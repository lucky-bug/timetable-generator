<?php

namespace App\Services\Iteration;

use Core\IterationControllerInterface;
use Core\EvaluatorInterface;
use Core\Population;

class SimpleIterationController implements IterationControllerInterface
{
    private EvaluatorInterface $fitnessCalculator;
    private int $expectedFitness;

    public function __construct(
        EvaluatorInterface $fitnessCalculator,
        int $expectedFitness
    ) {
        $this->fitnessCalculator = $fitnessCalculator;
        $this->expectedFitness = $expectedFitness;
    }

    public function shouldContinue(Population $population): bool
    {
        if ($population->getIndividual(0)->getFitness() >= $this->expectedFitness) {
            return false;
        }

        return true;
    }
}
