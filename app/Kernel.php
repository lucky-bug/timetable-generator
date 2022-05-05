<?php

namespace App;

use App\Services\Writers\WriterInterface;
use Core\IterationBreakerInterface;
use Core\Population;
use Core\ReproductionAlgorithmInterface;
use Core\SelectionAlgorithmInterface;

class Kernel
{
    private SelectionAlgorithmInterface $selectionAlgorithm;
    private ReproductionAlgorithmInterface $reproductionAlgorithm;
    private IterationBreakerInterface $iterationBreaker;
    private WriterInterface $writer;

    public function __construct(
        SelectionAlgorithmInterface $selectionAlgorithm,
        ReproductionAlgorithmInterface $reproductionAlgorithm,
        IterationBreakerInterface $iterationBreaker,
        WriterInterface $writer
    ) {
        $this->selectionAlgorithm = $selectionAlgorithm;
        $this->reproductionAlgorithm = $reproductionAlgorithm;
        $this->iterationBreaker = $iterationBreaker;
        $this->writer = $writer;
    }

    public function handle(Population $initialPopulation): void
    {
        $this->writer->write($this->iterate($initialPopulation)->getFirst());
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
