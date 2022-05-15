<?php

namespace App\Entities;

class Lesson
{
    private int $id;
    private string $name;
    private string $group;
    private int $size;
    private string $requiredClassroomType;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @return string[]
     */
    public function getGroups(): array
    {
        return explode(';', $this->group);
    }

    public function setGroup(string $group): void
    {
        $this->group = $group;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getRequiredClassroomType(): string
    {
        return $this->requiredClassroomType;
    }

    public function setRequiredClassroomType(string $requiredClassroomType): void
    {
        $this->requiredClassroomType = $requiredClassroomType;
    }

    public function __toString(): string
    {
        return sprintf("%s", $this->name);
    }
}
