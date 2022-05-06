<?php

namespace App;

use App\Services\Writers\WriterInterface;
use Core\ConvergenceCheckerInterface;
use Core\Population;
use Core\ReproductionAlgorithmInterface;
use Core\SelectionAlgorithmInterface;

class Kernel
{
    private SelectionAlgorithmInterface $selectionAlgorithm;
    private ReproductionAlgorithmInterface $reproductionAlgorithm;
    private ConvergenceCheckerInterface $convergenceChecker;
    private WriterInterface $writer;

    public function __construct(
        SelectionAlgorithmInterface $selectionAlgorithm,
        ReproductionAlgorithmInterface $reproductionAlgorithm,
        ConvergenceCheckerInterface $convergenceChecker,
        WriterInterface $writer
    ) {
        $this->selectionAlgorithm = $selectionAlgorithm;
        $this->reproductionAlgorithm = $reproductionAlgorithm;
        $this->convergenceChecker = $convergenceChecker;
        $this->writer = $writer;
    }

    public function handle(Population $initialPopulation): void
    {
        $this->writer->write(
            json_encode(
                $this->iterate($initialPopulation)->getAll(),
                JSON_PRETTY_PRINT
            )
        );
    }

    private function iterate(Population $population): Population
    {
        if ($this->convergenceChecker->check($population)) {
            return $population;
        }

        return $this->iterate(
            $this->reproductionAlgorithm->reproduce(
                $this->selectionAlgorithm->select($population)
            )
        );
    }
}
