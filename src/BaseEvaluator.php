<?php

namespace Core;

abstract class BaseEvaluator implements EvaluatorInterface
{
    public function getPerfectFitness(): int
    {
        return self::PERFECT_FITNESS;
    }
}
