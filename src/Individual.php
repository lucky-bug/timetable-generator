<?php

namespace Core;

class Individual
{
    private string $genes;
    private int $fitness;

    public function getGenes(): string
    {
        return $this->genes;
    }

    public function setGenes(string $genes): void
    {
        $this->genes = $genes;
    }

    public function getFitness(): int
    {
        return $this->fitness;
    }

    public function setFitness(int $fitness): void
    {
        $this->fitness = $fitness;
    }
}
