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

    public function get(int $id): ?Lesson
    {
        return $this->lessons[$id - 1] ?? null;
    }

    public function getCount(): int
    {
        return count($this->lessons);
    }

    public function store(Lesson $lesson): void
    {
        $this->lessons[$this->lastId++] = $lesson;
        $lesson->setId($this->lastId);
    }
}
