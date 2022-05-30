<?php

namespace App\Services\Generators;

use App\Repositories\ClassroomRepository;
use App\Repositories\LessonRepository;
use Core\EvaluatorInterface;
use Core\Individual;
use Core\Population;
use Core\PopulationGeneratorInterface;

class SimplePopulationGenerator implements PopulationGeneratorInterface
{
    private RandomNumberGeneratorInterface $randomNumberGenerator;
    private ClassroomRepository $classroomRepository;
    private LessonRepository $lessonRepository;
    private EvaluatorInterface $evaluator;
    private int $slots;
    private int $genesPerLesson;

    public function __construct(
        RandomNumberGeneratorInterface $randomNumberGenerator,
        ClassroomRepository $classroomRepository,
        LessonRepository $lessonRepository,
        EvaluatorInterface $evaluator,
        int $slots,
        int $genesPerLesson
    ) {
        $this->randomNumberGenerator = $randomNumberGenerator;
        $this->classroomRepository = $classroomRepository;
        $this->lessonRepository = $lessonRepository;
        $this->evaluator = $evaluator;
        $this->slots = $slots;
        $this->genesPerLesson = $genesPerLesson;
    }

    public function generate(int $size): Population
    {
        $population = new Population();
        $lessonsPerIndividual = $this->slots * $this->classroomRepository->getCount();

        for ($i = 0; $i < $size; $i++) {
            $genes = '';

            $numbers = range(1, $this->lessonRepository->getCount());
            $numbers = array_merge($numbers, array_fill(0, $lessonsPerIndividual - count($numbers), 0));
            shuffle($numbers);

            for ($j = 0; $j < $lessonsPerIndividual; $j++) {
                $genes .= str_pad(
                    base_convert($numbers[$j], 10, 2),
                    $this->genesPerLesson,
                    '0',
                    STR_PAD_LEFT
                );
            }

            $individual = new Individual();
            $individual->setGenes($genes);
            $individual->setFitness($this->evaluator->evaluate($genes));

            $population->addIndividual($individual);
        }

        return $population;
    }
}
