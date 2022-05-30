<?php

namespace Core;

class Population
{
    /**
     * @var Individual[]
     */
    private array $individuals;

    public function __construct()
    {
        $this->individuals = [];
    }

    /**
     * @return Individual[]
     */
    public function getIndividuals(): array
    {
        return $this->individuals;
    }

    public function getIndividual(int $index): ?Individual
    {
        return $this->individuals[$index] ?? null;
    }

    public function addIndividual(Individual $individual): void
    {
        $this->individuals[] = clone $individual;
    }

    public function getSize(): int
    {
        return count($this->individuals);
    }
}
