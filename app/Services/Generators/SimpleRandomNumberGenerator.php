<?php

namespace App\Services\Generators;

class SimpleRandomNumberGenerator implements RandomNumberGeneratorInterface
{
    public function generateInt(int $from, int $to): int
    {
        return mt_rand($from, $to);
    }

    public function generateFloat(float $from, float $to): float
    {
        return mt_rand() / mt_getrandmax() * ($to - $from) + $from;
    }
}
