<?php

namespace Core;

class Population
{
    /**
     * @var string[]
     */
    private array $individuals;
    private int $size;

    public function __construct()
    {
        $this->individuals = [];
        $this->size = 0;
    }

    /**
     * @return string[]
     */
    public function getAll(): array
    {
        return $this->individuals;
    }

    public function getFirst(): string
    {
        return $this->individuals[0];
    }

    /**
     * @param string[] $individuals
     * @return $this
     */
    public function setAll(array $individuals): self
    {
        $this->individuals = $individuals;
        $this->size = count($individuals);

        return $this;
    }

    /**
     * @return $this
     */
    public function add(string $individual): self
    {
        $this->individuals[] = $individual;
        $this->size++;

        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}
