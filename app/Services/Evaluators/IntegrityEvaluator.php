<?php

namespace App\Services\Evaluators;

use App\Repositories\LessonRepository;
use App\Services\Resolvers\LessonsResolver;
use Core\BaseEvaluator;

class IntegrityEvaluator extends BaseEvaluator
{
    private LessonsResolver $genesToLessonsMapper;
    private LessonRepository $lessonRepository;

    public function __construct(
        LessonsResolver $genesToLessonsMapper,
        LessonRepository $lessonRepository
    ) {
        $this->genesToLessonsMapper = $genesToLessonsMapper;
        $this->lessonRepository = $lessonRepository;
    }

    public function evaluate(string $individual): int
    {
        $allocatedLessons = [];

        foreach ($this->genesToLessonsMapper->resolve($individual) as $lesson) {
            if ($lesson->getId() > 0) {
                $allocatedLessons[$lesson->getId()] = ($allocatedLessons[$lesson->getId()] ?? 0) + 1;
            }
        }

        $fitness = count($allocatedLessons) - $this->lessonRepository->getCount();
        $fitness += array_sum(
            array_map(
                fn ($value) => $value === 1 ? 0 : -$value,
                array_values($allocatedLessons)
            )
        );

        if ($fitness === 0) {
            return self::PERFECT_FITNESS;
        }

        return $fitness;
    }
}
