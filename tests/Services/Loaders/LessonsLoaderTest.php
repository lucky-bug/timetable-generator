<?php

namespace Tests\Services\Loaders;

use App\Entities\Lesson;
use App\Repositories\LessonRepository;
use App\Services\Denormalizers\LessonDenormalizer;
use App\Services\Loaders\LessonsLoader;
use App\Services\Readers\CsvReader;
use PHPUnit\Framework\TestCase;

class LessonsLoaderTest extends TestCase
{
    private LessonRepository $repository;
    private LessonsLoader $loader;

    protected function setUp(): void
    {
        $this->repository = new LessonRepository();
        $this->loader = new LessonsLoader(
            new CsvReader(true),
            new LessonDenormalizer(),
            $this->repository
        );
    }

    public function testLoad()
    {
        $this->loader->load('tests/Resources/lessons.csv');
        self::assertEquals(5, $this->repository->getCount());
    }

    public function testGetDataClass()
    {
        self::assertEquals(Lesson::class, $this->loader->getDataClass());
    }
}
