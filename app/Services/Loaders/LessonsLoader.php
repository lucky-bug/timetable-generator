<?php

namespace App\Services\Loaders;

use App\Entities\Lesson;
use App\Repositories\LessonRepository;
use App\Services\Denormalizers\LessonDenormalizer;
use App\Services\Readers\ReaderInterface;

class LessonsLoader implements LoaderInterface
{
    private ReaderInterface $reader;
    private LessonDenormalizer $lessonDenormalizer;
    private LessonRepository $lessonRepository;

    public function __construct(
        ReaderInterface $reader,
        LessonDenormalizer $lessonDenormalizer,
        LessonRepository $lessonRepository
    ) {
        $this->reader = $reader;
        $this->lessonDenormalizer = $lessonDenormalizer;
        $this->lessonRepository = $lessonRepository;
    }

    public function load(string $filename): void
    {
        foreach ($this->reader->read($filename) as $data) {
            $this->lessonRepository->store(
                $this->lessonDenormalizer->mapToEntity($data)
            );
        }
    }

    public function getDataClass(): string
    {
        return Lesson::class;
    }
}
