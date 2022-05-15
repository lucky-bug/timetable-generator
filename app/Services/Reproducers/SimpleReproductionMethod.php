<?php

namespace App\Services\Reproducers;

use App\Services\Generators\RandomNumberGeneratorInterface;
use App\Services\Generators\UniqueRandomNumberGeneratorInterface;
use Core\MutatorInterface;
use Core\Population;
use Core\ReproductionMethodInterface;

class SimpleReproductionMethod implements ReproductionMethodInterface
{
    private UniqueRandomNumberGeneratorInterface $uniqueRandomNumberGenerator;
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private MutatorInterface $mutator;
    private int $expectedPopulationSize;

    public function __construct(
        UniqueRandomNumberGeneratorInterface $uniqueRandomNumberGenerator,
        RandomNumberGeneratorInterface $randomNumberGenerator,
        MutatorInterface $mutator,
        int $expectedPopulationSize
    ) {
        $this->uniqueRandomNumberGenerator = $uniqueRandomNumberGenerator;
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->mutator = $mutator;
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
                $this->mutator->mutate(
                    substr($firstParent, 0, $crossoverPoint) . substr($secondParent, $crossoverPoint)
                )
            );
        }

        return $population;
    }
}
