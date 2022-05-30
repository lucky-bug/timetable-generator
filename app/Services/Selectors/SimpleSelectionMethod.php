<?php

namespace App\Services\Selectors;

use Core\EvaluatorInterface;
use Core\Individual;
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

        $individuals = $population->getIndividuals();

        usort(
            $individuals,
            function (Individual $first, Individual $second) {
                return $first->getFitness() < $second->getFitness();
            }
        );

        foreach (range(0, $this->totalFittestToSelect - 1) as $i) {
            $newPopulation->addIndividual($individuals[$i]);
        }

        shuffle($individuals);

        foreach (range(0, $this->totalNonFitToSelect - 1) as $i) {
            $newPopulation->addIndividual($individuals[$i]);
        }

        return $newPopulation;
    }
}
