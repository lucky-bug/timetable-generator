<?php

namespace App\Repositories;

use App\Entities\Group;

class GroupRepository
{
    /**
     * @var Group[]
     */
    private array $groups;
    private int $lastId;

    public function __construct()
    {
        $this->groups = [];
        $this->lastId = 0;
    }

    public function get(int $id): ?Group
    {
        return $this->groups[$id - 1] ?? null;
    }

    public function getCount(): int
    {
        return count($this->groups);
    }

    public function store(Group $group): void
    {
        $this->groups[$this->lastId++] = $group;
        $group->setId($this->lastId);
    }
}
