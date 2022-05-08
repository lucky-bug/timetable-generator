<?php

namespace App\Services\Calculators;

use App\Entities\Lesson;
use App\Repositories\ClassroomRepository;
use App\Repositories\GroupRepository;
use App\Services\Mapper\GenesToLessonsMapper;
use Core\FitnessCalculatorInterface;

class CapacityFitnessCalculator implements FitnessCalculatorInterface
{
    private GenesToLessonsMapper $genesToLessonsMapper;
    private ClassroomRepository $classroomRepository;
    private GroupRepository $groupRepository;

    public function __construct(
        GenesToLessonsMapper $genesToLessonsMapper,
        ClassroomRepository $classroomRepository,
        GroupRepository $groupRepository
    ) {
        $this->genesToLessonsMapper = $genesToLessonsMapper;
        $this->classroomRepository = $classroomRepository;
        $this->groupRepository = $groupRepository;
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
                $group = $this->groupRepository->get($periodLesson->getGroupId());

                if ($classroom->getCapacity() < $group->getSize()) {
                    $fitness--;
                }
            }
        }

        return $fitness === 0 ? self::PERFECT_FITNESS : $fitness;
    }
}
