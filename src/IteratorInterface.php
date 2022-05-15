<?php

namespace Core;

interface IteratorInterface
{
    public function reset(): void;
    public function iterate(Population $initialPopulation): Population;
    public function getTotalIterations(): int;
}
