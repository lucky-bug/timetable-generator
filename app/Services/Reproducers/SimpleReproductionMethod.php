<?php

namespace App\Services\Reproducers;

use App\Services\Generators\RandomNumberGeneratorInterface;
use App\Services\Generators\UniqueRandomNumberGeneratorInterface;
use Core\EvaluatorInterface;
use Core\Individual;
use Core\MutatorInterface;
use Core\Population;
use Core\ReproductionMethodInterface;

class SimpleReproductionMethod implements ReproductionMethodInterface
{
    private UniqueRandomNumberGeneratorInterface $uniqueRandomNumberGenerator;
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private MutatorInterface $mutator;
    private EvaluatorInterface $evaluator;
    private int $expectedPopulationSize;

    public function __construct(
        UniqueRandomNumberGeneratorInterface $uniqueRandomNumberGenerator,
        RandomNumberGeneratorInterface $randomNumberGenerator,
        MutatorInterface $mutator,
        EvaluatorInterface $evaluator,
        int $expectedPopulationSize
    ) {
        $this->uniqueRandomNumberGenerator = $uniqueRandomNumberGenerator;
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->mutator = $mutator;
        $this->evaluator = $evaluator;
        $this->expectedPopulationSize = $expectedPopulationSize;
    }

    public function reproduce(Population $population): Population
    {
        $initialPopulationSize = $population->getSize();

        while ($population->getSize() < $this->expectedPopulationSize) {
            $this->uniqueRandomNumberGenerator->reset();
            $firstParentIndex = $this->uniqueRandomNumberGenerator->generateInt(0, $initialPopulationSize - 1);
            $secondParentIndex = $this->uniqueRandomNumberGenerator->generateInt(0, $initialPopulationSize - 1);
            $firstParent = $population->getIndividual($firstParentIndex);
            $secondParent = $population->getIndividual($secondParentIndex);
            $crossoverPoint = $this->randomNumberGenerator->generateInt(1, strlen($firstParent->getGenes()) - 1);
//            $crossoverPoint = strlen($firstParent->getGenes()) / 2;

            $genes = $this->mutator->mutate(
                substr($firstParent->getGenes(), 0, $crossoverPoint) . substr($secondParent->getGenes(), $crossoverPoint)
            );
            $individual = new Individual();
            $individual->setGenes($genes);
            $individual->setFitness($this->evaluator->evaluate($genes));
            $population->addIndividual($individual);
        }

        return $population;
    }
}
