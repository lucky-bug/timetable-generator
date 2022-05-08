<?php

namespace App\Entities;

class Lesson
{
    private int $id;
    private string $name;
    private int $groupId;
    private bool $taughtInLaboratory;

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

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function isTaughtInLaboratory(): bool
    {
        return $this->taughtInLaboratory;
    }

    public function setTaughtInLaboratory(bool $taughtInLaboratory): void
    {
        $this->taughtInLaboratory = $taughtInLaboratory;
    }
}
