<?php

namespace App\Services;

use Core\ConvergenceCheckerInterface;
use Core\FitnessCalculatorInterface;
use Core\Population;

class SimpleConvergenceChecker implements ConvergenceCheckerInterface
{
    private FitnessCalculatorInterface $fitnessCalculator;
    private int $expectedFitness;

    public function __construct(
        FitnessCalculatorInterface $fitnessCalculator,
        int $expectedFitness
    ) {
        $this->fitnessCalculator = $fitnessCalculator;
        $this->expectedFitness = $expectedFitness;
    }

    public function check(Population $population): bool
    {
        if ($this->fitnessCalculator->calculate($population->get(0)) >= $this->expectedFitness) {
            return true;
        }

        return false;
    }
}
