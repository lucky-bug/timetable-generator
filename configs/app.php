<?php

use App\Services\Evaluators\CapacityEvaluator;
use App\Services\Evaluators\GroupAvailabilityEvaluator;
use App\Services\Evaluators\IntegrityEvaluator;
use App\Services\Evaluators\TypeEvaluator;
use App\Services\Generators\RandomNumberGeneratorInterface;
use App\Services\Generators\SimpleRandomNumberGenerator;
use App\Services\Generators\SimpleUniqueRandomNumberGenerator;
use App\Services\Generators\UniqueRandomNumberGeneratorInterface;
use App\Services\Resolvers\LessonsResolver;
use Core\EvaluatorInterface;
use Psr\Container\ContainerInterface;
use function DI\autowire;
use function DI\get;

return [
    'populationSize' => 100,
    'totalFittestToSelect' => 15,
    'totalNonFitToSelect' => 35,
    'slots' => fn (ContainerInterface $container) => $container->get('weeksPerTimetable') * $container->get('daysPerTimetable') * $container->get('periodsPerTimetable'),
    'genesPerLesson' => 11,
    'weeksPerTimetable' => 2,
    'daysPerTimetable' => 6,
    'periodsPerTimetable' => 7,
    'mutationRate' => .1,
    'evaluators' => [
        get(CapacityEvaluator::class),
        get(GroupAvailabilityEvaluator::class),
        get(IntegrityEvaluator::class),
        get(TypeEvaluator::class),
    ],
    'expectedFitness' => fn (ContainerInterface $container)  => array_sum(
        array_map(
            fn (EvaluatorInterface $evaluator) => $evaluator->getPerfectFitness(),
            $container->get('evaluators')
        )
    ),
    LessonsResolver::class => autowire(LessonsResolver::class)->constructorParameter('genesPerLesson', get('genesPerLesson')),
    RandomNumberGeneratorInterface::class => autowire(SimpleRandomNumberGenerator::class),
    UniqueRandomNumberGeneratorInterface::class => autowire(SimpleUniqueRandomNumberGenerator::class),
];
