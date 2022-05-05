<?php

namespace Tests\Services;

use App\Services\SimpleConvergenceChecker;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimpleIterationBreakerTest extends TestCase
{
    private SimpleConvergenceChecker $iterationBreaker;

    protected function setUp(): void
    {
        $this->iterationBreaker = new SimpleConvergenceChecker();
    }

    public function testCheck()
    {
        self::assertEquals(true, $this->iterationBreaker->check(new Population()));
    }
}
