<?php

namespace App\Services\Loaders;

use App\Entities\Classroom;
use App\Repositories\ClassroomRepository;
use App\Services\Denormalizers\ClassroomDenormalizer;
use App\Services\IO\Readers\ReaderInterface;

class ClassroomsLoader implements LoaderInterface
{
    private ReaderInterface $reader;
    private ClassroomDenormalizer $classroomDenormalizer;
    private ClassroomRepository $classroomRepository;

    public function __construct(
        ReaderInterface $reader,
        ClassroomDenormalizer $classroomDenormalizer,
        ClassroomRepository $classroomRepository
    ) {
        $this->reader = $reader;
        $this->classroomDenormalizer = $classroomDenormalizer;
        $this->classroomRepository = $classroomRepository;
    }

    public function load(string $filename): void
    {
        foreach ($this->reader->read($filename) as $data) {
            $this->classroomRepository->store(
                $this->classroomDenormalizer->mapToEntity($data)
            );
        }
    }

    public function getDataClass(): string
    {
        return Classroom::class;
    }
}
