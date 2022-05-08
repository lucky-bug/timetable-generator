<?php

namespace Core;

class FitnessCalculatorChain implements FitnessCalculatorInterface
{
    /**
     * @var FitnessCalculatorInterface[]
     */
    private array $fitnessCalculators;

    /**
     * @param FitnessCalculatorInterface[] $fitnessCalculators
     */
    public function __construct(
        array $fitnessCalculators
    ) {
        $this->fitnessCalculators = $fitnessCalculators;
    }

    public function calculate(string $individual): int
    {
        return array_sum(
            array_map(
                fn(FitnessCalculatorInterface $fitnessCalculator) => $fitnessCalculator->calculate($individual),
                $this->fitnessCalculators
            )
        );
    }
}
