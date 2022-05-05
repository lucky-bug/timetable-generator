<?php

namespace App\Repositories;

use App\Entities\Lesson;

class LessonRepository
{
    /**
     * @var Lesson[]
     */
    private array $lessons;
    private int $lastId;

    public function __construct()
    {
        $this->lessons = [];
        $this->lastId = 0;
    }

    public function get(int $id): Lesson
    {
        return $this->lessons[$id];
    }

    public function store(Lesson $lesson): void
    {
        $this->lastId++;
        $lesson->setId($this->lastId);
        $this->lessons[$this->lastId] = $lesson;
    }
}
