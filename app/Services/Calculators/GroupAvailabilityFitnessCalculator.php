<?php

namespace App\Services\Calculators;

use App\Entities\Lesson;
use App\Repositories\ClassroomRepository;
use App\Services\Mapper\GenesToLessonsMapper;
use Core\FitnessCalculatorInterface;

class GroupAvailabilityFitnessCalculator implements FitnessCalculatorInterface
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
            $groupsHavingLessons = [];

            /** @var Lesson $periodLesson */
            foreach ($periodLessons as $periodLesson) {
                if ($periodLesson->getId() === 0) {
                    continue;
                }

                $groupsHavingLessons[$periodLesson->getGroupId()] = ($groupsHavingLessons[$periodLesson->getGroupId()] ?? 0) + 1;
            }

            $fitness += array_sum(
                array_map(
                    fn ($value) => $value === 1 ? 0 : -$value,
                    array_values($groupsHavingLessons)
                )
            );
        }

        return $fitness === 0 ? self::PERFECT_FITNESS : $fitness;
    }
}
