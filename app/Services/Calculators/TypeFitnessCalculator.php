<?php

namespace App\Services\Calculators;

use App\Entities\Lesson;
use App\Repositories\ClassroomRepository;
use App\Services\Mapper\GenesToLessonsMapper;
use Core\FitnessCalculatorInterface;

class TypeFitnessCalculator implements FitnessCalculatorInterface
{
    private GenesToLessonsMapper $genesToLessonsMapper;
    private ClassroomRepository $classroomRepository;

    public function __construct(
        GenesToLessonsMapper $genesToLessonsMapper,
        ClassroomRepository $classroomRepository
    ) {
        $this->genesToLessonsMapper = $genesToLessonsMapper;
        $this->classroomRepository = $classroomRepository;
    }

    public function calculate(string $individual): int
    {
        $fitness = 0;
        $lessons = $this->genesToLessonsMapper->map($individual);

        foreach (array_chunk($lessons, $this->classroomRepository->getCount()) as $periodLessons) {
            /** @var Lesson $periodLesson */
            foreach ($periodLessons as $classroomIndex => $periodLesson) {
                if ($periodLesson->getId() === 0) {
                    continue;
                }

                $classroom = $this->classroomRepository->get($classroomIndex + 1);

                if ($periodLesson->isTaughtInLaboratory() && !$classroom->isLaboratory()) {
                    $fitness--;
                }
            }
        }

        return $fitness === 0 ? self::PERFECT_FITNESS : $fitness;
    }
}
