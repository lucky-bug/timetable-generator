<?php

namespace App\Entities;

class Classroom
{
    private int $id;
    private string $building;
    private string $number;
    private int $capacity;
    private string $type;

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

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function __toString()
    {
        return sprintf("Building: %s; Number: %s", $this->building, $this->number);
    }
}
