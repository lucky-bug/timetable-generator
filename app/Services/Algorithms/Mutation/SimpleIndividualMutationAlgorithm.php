<?php

namespace App\Services\Algorithms\Mutation;

use Core\IndividualMutationAlgorithmInterface;

class SimpleIndividualMutationAlgorithm implements IndividualMutationAlgorithmInterface
{
    public function mutate(string $individual): string
    {
        return $individual;
    }
}
