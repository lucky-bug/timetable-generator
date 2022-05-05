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

    public function get(int $id): Classroom
    {
        return $this->classrooms[$id];
    }

    public function store(Classroom $classroom): void
    {
        $this->lastId++;
        $classroom->setId($this->lastId);
        $this->classrooms[$this->lastId] = $classroom;
    }
}
