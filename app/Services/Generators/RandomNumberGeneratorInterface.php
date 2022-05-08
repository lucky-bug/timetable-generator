<?php

namespace App\Services\Generators;

interface RandomNumberGeneratorInterface
{
    public function generateInt(int $from, int $to): int;
    public function generateFloat(float $from, float $to): float;
}
