<?php

namespace Core;

class EvaluatorChain implements EvaluatorInterface
{
    /**
     * @var EvaluatorInterface[]
     */
    private array $evaluators;

    /**
     * @param EvaluatorInterface[] $fitnessCalculators
     */
    public function __construct(
        array $fitnessCalculators
    ) {
        $this->evaluators = $fitnessCalculators;
    }

    public function evaluate(string $individual): int
    {
        return array_sum(
            array_map(
                fn(EvaluatorInterface $fitnessCalculator) => $fitnessCalculator->evaluate($individual),
                $this->evaluators
            )
        );
    }

    public function getPerfectFitness(): int
    {
        return array_sum(
            array_map(
                fn (EvaluatorInterface $evaluator) => $evaluator->getPerfectFitness(),
                $this->evaluators
            )
        );
    }
}
