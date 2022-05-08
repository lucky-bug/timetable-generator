<?php

namespace Tests\Services\Generators;

use App\Services\Generators\SimpleRandomNumberGenerator;
use PHPUnit\Framework\TestCase;

class SimpleRandomNumberGeneratorTest extends TestCase
{
    private const ASSERTIONS = 100;

    private SimpleRandomNumberGenerator $generator;

    protected function setUp(): void
    {
        $this->generator = new SimpleRandomNumberGenerator();
    }

    public function testGenerateInt(): void
    {
        for ($i = 0; $i < self::ASSERTIONS; $i++) {
            $number = $this->generator->generateInt(1, 10);
            self::assertIsInt($number);
            self::assertGreaterThanOrEqual(1, $number);
            self::assertLessThanOrEqual(10, $number);

            $number = $this->generator->generateInt(-10, -1);
            self::assertIsInt($number);
            self::assertGreaterThanOrEqual(-10, $number);
            self::assertLessThanOrEqual(-1, $number);
        }
    }

    public function testGenerateFloat(): void
    {
        for ($i = 0; $i < self::ASSERTIONS; $i++) {
            $number = $this->generator->generateFloat(.1, .9);
            self::assertIsFloat($number);
            self::assertGreaterThanOrEqual(.1, $number);
            self::assertLessThanOrEqual(.9, $number);

            $number = $this->generator->generateFloat(-.9, -.1);
            self::assertIsFloat($number);
            self::assertGreaterThanOrEqual(-.9, $number);
            self::assertLessThanOrEqual(-.1, $number);
        }
    }
}
