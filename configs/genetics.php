<?php

use App\Services\Generators\SimplePopulationGenerator;
use App\Services\Iteration\SimpleIterationController;
use App\Services\Iteration\SimpleIterator;
use App\Services\Iteration\SimpleIteratorWithPreview;
use App\Services\Mutators\SimpleMutator;
use App\Services\Reproducers\SimpleReproductionMethod;
use App\Services\Selectors\SimpleSelectionMethod;
use Core\EvaluatorChain;
use Core\EvaluatorInterface;
use Core\IterationControllerInterface;
use Core\IteratorInterface;
use Core\MutatorInterface;
use Core\PopulationGeneratorInterface;
use Core\ReproductionMethodInterface;
use Core\SelectionMethodInterface;
use function DI\autowire;
use function DI\create;
use function DI\get;

return [
    EvaluatorInterface::class => create(EvaluatorChain::class)->constructor(get('evaluators')),
    MutatorInterface::class => autowire(SimpleMutator::class)->constructorParameter('mutationRate', get('mutationRate')),
    ReproductionMethodInterface::class => autowire(SimpleReproductionMethod::class)->constructorParameter('expectedPopulationSize', get('populationSize')),
    SelectionMethodInterface::class => autowire(SimpleSelectionMethod::class)
        ->constructorParameter('totalFittestToSelect', get('totalFittestToSelect'))
        ->constructorParameter('totalNonFitToSelect', get('totalNonFitToSelect')),
    IterationControllerInterface::class => autowire(SimpleIterationController::class)->constructorParameter('expectedFitness', get('expectedFitness')),
    IteratorInterface::class => get(SimpleIteratorWithPreview::class),
    PopulationGeneratorInterface::class => autowire(SimplePopulationGenerator::class)
        ->constructorParameter('slots', get('slots'))
        ->constructorParameter('genesPerLesson', get('genesPerLesson')),
];
