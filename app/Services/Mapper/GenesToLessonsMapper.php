<?php

namespace App\Services\Mapper;

use App\Entities\Lesson;
use App\Repositories\LessonRepository;

class GenesToLessonsMapper
{
    private LessonRepository $lessonRepository;
    private int $genesPerLesson;

    public function __construct(
        LessonRepository $lessonRepository,
        int $genesPerLesson
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->genesPerLesson = $genesPerLesson;
    }

    /**
     * @return Lesson[]
     */
    public function map(string $genes): array
    {
        $lessons = [];

        foreach (str_split($genes, $this->genesPerLesson) as $lessonGenes) {
            $lessonId = intval($lessonGenes, 2);
            $emptyLesson = new Lesson();
            $emptyLesson->setId(0);

            $lesson = $this->lessonRepository->get($lessonId) ?? $emptyLesson;

            $lessons[] = $lesson;
        }

        return $lessons;
    }
}
