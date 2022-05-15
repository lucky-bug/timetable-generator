<?php

namespace App\Repositories;

use App\Entities\Classroom;

class ClassroomRepository
{
    /**
     * @var Classroom[]
     */
    private array $classrooms;
    private int $lastId;

    public function __construct()
    {
        $this->classrooms = [];
        $this->lastId = 0;
    }

    /**
     * @return Classroom[]
     */
    public function getAll(): array
    {
        return $this->classrooms;
    }

    public function get(int $id): ?Classroom
    {
        return $this->classrooms[$id - 1] ?? null;
    }

    public function getCount(): int
    {
        return count($this->classrooms);
    }

    public function store(Classroom $classroom): void
    {
        $this->classrooms[$this->lastId++] = $classroom;
        $classroom->setId($this->lastId);
    }
}
