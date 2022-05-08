<?php

namespace App\Services\Generators;

class SimpleUniqueRandomNumberGenerator implements UniqueRandomNumberGeneratorInterface
{
    private array $generatedIntegers;
    private array $generatedFloats;
    private RandomNumberGeneratorInterface $randomNumberGenerator;

    public function __construct(
        RandomNumberGeneratorInterface $randomNumberGenerator
    ) {
        $this->reset();
        $this->randomNumberGenerator = $randomNumberGenerator;
    }

    public function generateInt(int $from, int $to): int
    {
        do {
            $number = $this->randomNumberGenerator->generateInt($from, $to);
        } while (in_array($number, $this->generatedIntegers));

        $this->generatedIntegers[] = $number;

        return $number;
    }

    public function generateFloat(float $from, float $to): float
    {
        do {
            $number = $this->randomNumberGenerator->generateFloat($from, $to);
        } while (in_array($number, $this->generatedFloats));

        $this->generatedFloats[] = $number;

        return $number;
    }

    public function reset(): void
    {
        $this->generatedIntegers = [];
        $this->generatedFloats = [];
    }
}
