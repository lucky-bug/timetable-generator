<?php

namespace App\Services\Denormalizers;

use Core\Individual;

class IndividualDenormalizer
{
    private const GENES_INDEX = 0;
    private const FITNESS_INDEX = 1;

    public function mapToEntity(array $data): Individual
    {
        $individual = new Individual();

        if (isset($data[self::GENES_INDEX])) {
            $individual->setGenes($data[self::GENES_INDEX]);
        }

        if (isset($data[self::FITNESS_INDEX])) {
            $individual->setFitness($data[self::FITNESS_INDEX]);
        }

        return $individual;
    }
}
