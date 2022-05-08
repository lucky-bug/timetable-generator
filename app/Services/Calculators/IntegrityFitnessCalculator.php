<?php

namespace App\Services\Calculators;

use App\Repositories\LessonRepository;
use App\Services\Mapper\GenesToLessonsMapper;
use Core\FitnessCalculatorInterface;

class IntegrityFitnessCalculator implements FitnessCalculatorInterface
{
    private GenesToLessonsMapper $genesToLessonsMapper;
    private LessonRepository $lessonRepository;

    public function __construct(
        GenesToLessonsMapper $genesToLessonsMapper,
        LessonRepository $lessonRepository
    ) {
        $this->genesToLessonsMapper = $genesToLessonsMapper;
        $this->lessonRepository = $lessonRepository;
    }

    public function calculate(string $individual): int
    {
        $allocatedLessons = [];

        foreach ($this->genesToLessonsMapper->map($individual) as $lesson) {
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
