<?php

namespace App\Services\Evaluators;

use App\Entities\Lesson;
use App\Repositories\ClassroomRepository;
use App\Services\Resolvers\LessonsResolver;
use Core\BaseEvaluator;

class TypeEvaluator extends BaseEvaluator
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
            /** @var Lesson $periodLesson */
            foreach ($periodLessons as $classroomIndex => $periodLesson) {
                if ($periodLesson->getId() === 0) {
                    continue;
                }

                $classroom = $this->classroomRepository->get($classroomIndex + 1);

                if ($periodLesson->getRequiredClassroomType() !== $classroom->getType()) {
                    $fitness--;
                }
            }
        }

        return $fitness === 0 ? self::PERFECT_FITNESS : $fitness;
    }
}
