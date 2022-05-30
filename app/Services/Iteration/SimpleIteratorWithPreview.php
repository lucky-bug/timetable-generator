<?php

namespace App\Services\Iteration;

use App\Services\IO\Writers\WriterInterface;
use Core\EvaluatorInterface;
use Core\IterationControllerInterface;
use Core\IteratorInterface;
use Core\Population;
use Core\ReproductionMethodInterface;
use Core\SelectionMethodInterface;

class SimpleIteratorWithPreview implements IteratorInterface
{
    private int $iterationsCount;
    private ReproductionMethodInterface $reproductionMethod;
    private SelectionMethodInterface $selectionMethod;
    private IterationControllerInterface $iterationController;
    private EvaluatorInterface $evaluator;
    private WriterInterface $writer;

    public function __construct(
        ReproductionMethodInterface $reproductionMethod,
        SelectionMethodInterface $selectionMethod,
        IterationControllerInterface $iterationController,
        EvaluatorInterface $evaluator,
        WriterInterface $writer
    ) {
        $this->reset();
        $this->reproductionMethod = $reproductionMethod;
        $this->selectionMethod = $selectionMethod;
        $this->iterationController = $iterationController;
        $this->evaluator = $evaluator;
        $this->writer = $writer;
    }

    public function reset(): void
    {
        $this->iterationsCount = 0;
    }

    public function iterate(Population $initialPopulation): Population
    {
        $population = clone $initialPopulation;

        while ($this->iterationController->shouldContinue($population)) {
            $population = $this->reproductionMethod->reproduce(
                $this->selectionMethod->select($population)
            );

            file_put_contents(sys_get_temp_dir() . '/fittest_genes.txt', $population->getIndividual(0)->getGenes());
            $this->writer->writeLine(sprintf("%d - %d", $this->iterationsCount, $population->getIndividual(0)->getFitness()));

            $this->iterationsCount++;
        }

        return $population;
    }

    public function getTotalIterations(): int
    {
        return $this->iterationsCount;
    }
}
