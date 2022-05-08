<?php

namespace Core;

interface FitnessCalculatorInterface
{
    const PERFECT_FITNESS = 100;

    public function calculate(string $individual): int;
}
