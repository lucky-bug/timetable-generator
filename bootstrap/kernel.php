<?php

use App\Kernel;
use App\Repositories\ClassroomRepository;
use App\Repositories\GroupRepository;
use App\Repositories\LessonRepository;
use App\Services\Algorithms\Mutation\SimpleIndividualMutationAlgorithm;
use App\Services\Algorithms\Reproduction\SimpleReproductionAlgorithm;
use App\Services\Algorithms\Selection\SimpleSelectionAlgorithm;
use App\Services\Calculators\CapacityFitnessCalculator;
use App\Services\Calculators\GroupAvailabilityFitnessCalculator;
use App\Services\Calculators\IntegrityFitnessCalculator;
use App\Services\Calculators\TypeFitnessCalculator;
use App\Services\Denormalizers\ClassroomDenormalizer;
use App\Services\Denormalizers\GroupDenormalizer;
use App\Services\Denormalizers\LessonDenormalizer;
use App\Services\Generators\SimplePopulationGenerator;
use App\Services\Generators\SimpleRandomNumberGenerator;
use App\Services\Generators\SimpleUniqueRandomNumberGenerator;
use App\Services\Loaders\ClassroomsLoader;
use App\Services\Loaders\GroupsLoader;
use App\Services\Loaders\LessonsLoader;
use App\Services\Mapper\GenesToLessonsMapper;
use App\Services\Readers\CsvReader;
use App\Services\SimpleConvergenceChecker;
use App\Services\Writers\SimpleWriter;
use Core\FitnessCalculatorChain;
use Core\FitnessCalculatorInterface;

$genesPerLesson = 4;
$populationSize = 4;
$totalSelection = 2;
$reader = new CsvReader(true);
$groupRepository = new GroupRepository();
$classroomRepository = new ClassroomRepository();
$lessonRepository = new LessonRepository();
$groupsLoader = new GroupsLoader(
    $reader,
    new GroupDenormalizer(),
    $groupRepository
);
$classroomsLoader = new ClassroomsLoader(
    $reader,
    new ClassroomDenormalizer(),
    $classroomRepository
);
$lessonsLoader = new LessonsLoader(
    $reader,
    new LessonDenormalizer(),
    $lessonRepository
);

$groupsLoader->load(__DIR__ . '/../resources/groups.csv');
$classroomsLoader->load(__DIR__ . '/../resources/classrooms.csv');
$lessonsLoader->load(__DIR__ . '/../resources/lessons.csv');

$genesToLessonsMapper = new GenesToLessonsMapper(
    $lessonRepository,
    $genesPerLesson
);
$fitnessCalculators = [
    new IntegrityFitnessCalculator(
        $genesToLessonsMapper,
        $lessonRepository
    ),
    new GroupAvailabilityFitnessCalculator(
        $genesToLessonsMapper,
        $classroomRepository
    ),
    new CapacityFitnessCalculator(
        $genesToLessonsMapper,
        $classroomRepository,
        $groupRepository
    ),
    new TypeFitnessCalculator(
        $genesToLessonsMapper,
        $classroomRepository
    ),
];
$fitnessCalculator = new FitnessCalculatorChain($fitnessCalculators);

$kernel = new Kernel(
    new SimpleSelectionAlgorithm(
        $fitnessCalculator,
        $totalSelection
    ),
    new SimpleReproductionAlgorithm(
        new SimpleUniqueRandomNumberGenerator(new SimpleRandomNumberGenerator()),
        new SimpleRandomNumberGenerator(),
        new SimpleIndividualMutationAlgorithm(
            new SimpleRandomNumberGenerator(),
            .01
        ),
        $populationSize
    ),
    new SimpleConvergenceChecker($fitnessCalculator, FitnessCalculatorInterface::PERFECT_FITNESS * count($fitnessCalculators)),
    $genesToLessonsMapper,
    new SimpleWriter('php://stdout')
);

$customIndividuals = [
    '00100000000000001010000001000000010101101001101110000000001100000111111111110001',
];
$initialPopulationGenerator = new SimplePopulationGenerator(
    new SimpleRandomNumberGenerator(),
    $lessonRepository,
    10 * $classroomRepository->getCount(),
    $genesPerLesson
);

$initialPopulation = $initialPopulationGenerator->generate($populationSize);

foreach ($customIndividuals as $customIndividual) {
    $initialPopulation->add($customIndividual);
}

$kernel->handle($initialPopulation);

return $kernel;
