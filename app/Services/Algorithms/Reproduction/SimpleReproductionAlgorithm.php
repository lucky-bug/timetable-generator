<?php

namespace App\Services\Algorithms\Reproduction;

use App\Services\Generators\RandomNumberGeneratorInterface;
use App\Services\Generators\UniqueRandomNumberGeneratorInterface;
use Core\IndividualMutationAlgorithmInterface;
use Core\Population;
use Core\ReproductionAlgorithmInterface;

class SimpleReproductionAlgorithm implements ReproductionAlgorithmInterface
{
    private UniqueRandomNumberGeneratorInterface $uniqueRandomNumberGenerator;
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private IndividualMutationAlgorithmInterface $individualMutationAlgorithm;
    private int $expectedPopulationSize;

    public function __construct(
        UniqueRandomNumberGeneratorInterface $uniqueRandomNumberGenerator,
        RandomNumberGeneratorInterface $randomNumberGenerator,
        IndividualMutationAlgorithmInterface $individualMutationAlgorithm,
        int $expectedPopulationSize
    ) {
        $this->uniqueRandomNumberGenerator = $uniqueRandomNumberGenerator;
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->individualMutationAlgorithm = $individualMutationAlgorithm;
        $this->expectedPopulationSize = $expectedPopulationSize;
    }

    public function reproduce(Population $population): Population
    {
        $initialPopulationSize = $population->getSize();

        while ($population->getSize() < $this->expectedPopulationSize) {
            $this->uniqueRandomNumberGenerator->reset();
            $firstParentIndex = $this->uniqueRandomNumberGenerator->generateInt(0, $initialPopulationSize - 1);
            $secondParentIndex = $this->uniqueRandomNumberGenerator->generateInt(0, $initialPopulationSize - 1);
            $firstParent = $population->get($firstParentIndex);
            $secondParent = $population->get($secondParentIndex);
            $crossoverPoint = $this->randomNumberGenerator->generateInt(1, strlen($firstParent) - 1);

            $population->add(
                $this->individualMutationAlgorithm->mutate(
                    substr($firstParent, 0, $crossoverPoint) . substr($secondParent, $crossoverPoint)
                )
            );
        }

        return $population;
    }
}
