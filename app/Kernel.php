<?php

namespace App;

use Core\IndividualWriterInterface;
use Core\IterationBreakerInterface;
use Core\Population;
use Core\ReproductionAlgorithmInterface;
use Core\SelectionAlgorithmInterface;

class Kernel
{
    private SelectionAlgorithmInterface $selectionAlgorithm;
    private ReproductionAlgorithmInterface $reproductionAlgorithm;
    private IterationBreakerInterface $iterationBreaker;
    private IndividualWriterInterface $individualWriter;

    public function __construct(
        SelectionAlgorithmInterface $selectionAlgorithm,
        ReproductionAlgorithmInterface $reproductionAlgorithm,
        IterationBreakerInterface $iterationBreaker,
        IndividualWriterInterface $individualWriter
    ) {
        $this->selectionAlgorithm = $selectionAlgorithm;
        $this->reproductionAlgorithm = $reproductionAlgorithm;
        $this->iterationBreaker = $iterationBreaker;
        $this->individualWriter = $individualWriter;
    }

    public function handle(Population $initialPopulation): void
    {
        $this->individualWriter->write($this->iterate($initialPopulation)->getFirst());
    }

    private function iterate(Population $population): Population
    {
        if ($this->iterationBreaker->check($population)) {
            return $population;
        }

        return $this->iterate(
            $this->reproductionAlgorithm->reproduce(
                $this->selectionAlgorithm->select($population)
            )
        );
    }
}
