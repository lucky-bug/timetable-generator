<?php

namespace Tests\Services\Loaders;

use App\Entities\Classroom;
use App\Repositories\ClassroomRepository;
use App\Services\Denormalizers\ClassroomDenormalizer;
use App\Services\Loaders\ClassroomsLoader;
use App\Services\Readers\CsvReader;
use PHPUnit\Framework\TestCase;

class ClassroomsLoaderTest extends TestCase
{
    private ClassroomRepository $repository;
    private ClassroomsLoader $loader;

    protected function setUp(): void
    {
        $this->repository = new ClassroomRepository();
        $this->loader = new ClassroomsLoader(
            new CsvReader(true),
            new ClassroomDenormalizer(),
            $this->repository
        );
    }

    public function testLoad()
    {
        $this->loader->load('tests/Resources/classrooms.csv');
        self::assertEquals(2, $this->repository->getCount());
    }

    public function testGetDataClass()
    {
        self::assertEquals(Classroom::class, $this->loader->getDataClass());
    }
}
