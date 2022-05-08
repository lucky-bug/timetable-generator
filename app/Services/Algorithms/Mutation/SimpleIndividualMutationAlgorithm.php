<?php

namespace App\Services\Algorithms\Mutation;

use App\Services\Generators\RandomNumberGeneratorInterface;
use Core\IndividualMutationAlgorithmInterface;

class SimpleIndividualMutationAlgorithm implements IndividualMutationAlgorithmInterface
{
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private float $mutationRate;

    public function __construct(
        RandomNumberGeneratorInterface $randomNumberGenerator,
        float $mutationRate
    ) {
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->mutationRate = $mutationRate;
    }

    public function mutate(string $individual): string
    {
        return implode(
            array_map(
                function(string $gene) {
                    if ($this->randomNumberGenerator->generateFloat(0, 1) < $this->mutationRate) {
                        return $gene === '0' ? '1' : '0';
                    }

                    return $gene;
                },
                str_split($individual)
            )
        );
    }
}
