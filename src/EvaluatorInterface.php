<?php

namespace Core;

interface EvaluatorInterface
{
    const PERFECT_FITNESS = 100;

    public function evaluate(string $individual): int;
    public function getPerfectFitness(): int;
}
