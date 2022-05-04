<?php

namespace Tests;

use App\SimpleIterationBreaker;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimpleIterationBreakerTest extends TestCase
{
    private SimpleIterationBreaker $iterationBreaker;

    protected function setUp(): void
    {
        $this->iterationBreaker = new SimpleIterationBreaker();
    }

    public function testCheck()
    {
        self::assertEquals(true, $this->iterationBreaker->check(new Population()));
    }
}
