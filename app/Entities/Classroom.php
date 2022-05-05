<?php

namespace App\Entities;

class Classroom
{
    private int $id;
    private string $building;
    private string $number;
    private bool $laboratory;

    public function __construct()
    {
        $this->id = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getBuilding(): string
    {
        return $this->building;
    }

    public function setBuilding(string $building): void
    {
        $this->building = $building;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function isLaboratory(): bool
    {
        return $this->laboratory;
    }

    public function setLaboratory(bool $laboratory): void
    {
        $this->laboratory = $laboratory;
    }
}
