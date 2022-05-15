<?php

namespace App\Services\Evaluators;

use App\Entities\Lesson;
use App\Repositories\ClassroomRepository;
use App\Services\Resolvers\LessonsResolver;
use Core\BaseEvaluator;

class GroupAvailabilityEvaluator extends BaseEvaluator
{
    private LessonsResolver $genesToLessonsMapper;
    private ClassroomRepository $classroomRepository;

    public function __construct(
        LessonsResolver $genesToLessonsMapper,
        ClassroomRepository $classroomRepository
    ) {
        $this->genesToLessonsMapper = $genesToLessonsMapper;
        $this->classroomRepository = $classroomRepository;
    }

    public function evaluate(string $individual): int
    {
        $fitness = 0;
        $lessons = $this->genesToLessonsMapper->resolve($individual);

        foreach (array_chunk($lessons, $this->classroomRepository->getCount()) as $periodLessons) {
            $groupsHavingLessons = [];

            /** @var Lesson $periodLesson */
            foreach ($periodLessons as $periodLesson) {
                if ($periodLesson->getId() === 0) {
                    continue;
                }

                $groups = array_unique($periodLesson->getGroups());

                foreach ($groups as $group) {
                    $groupsHavingLessons[$group] = ($groupsHavingLessons[$group] ?? 0) + 1;
                }
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
