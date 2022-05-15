<?php

namespace App\Services\Selectors;

use Core\EvaluatorInterface;
use Core\Population;
use Core\SelectionMethodInterface;

class SimpleSelectionMethod implements SelectionMethodInterface
{
    private EvaluatorInterface $evaluator;
    private int $totalFittestToSelect;
    private int $totalNonFitToSelect;

    public function __construct(
        EvaluatorInterface $evaluator,
        int $totalFittestToSelect,
        int $totalNonFitToSelect
    ) {
        $this->evaluator = $evaluator;
        $this->totalFittestToSelect = $totalFittestToSelect;
        $this->totalNonFitToSelect = $totalNonFitToSelect;
    }

    public function select(Population $population): Population
    {
        $newPopulation = new Population();

        $genesList = $population->getAll();

        usort(
            $genesList,
            function (string $firstGenes, string $secondGenes) {
                return $this->evaluator->evaluate($firstGenes) < $this->evaluator->evaluate($secondGenes);
            }
        );

        $newPopulation->setAll(
            array_slice(
                $genesList,
                0,
                $this->totalFittestToSelect
            )
        );

        shuffle($genesList);

        foreach (range(0, $this->totalNonFitToSelect - 1) as $i) {
            $newPopulation->add($genesList[$i]);
        }

        return $newPopulation;
    }
}
