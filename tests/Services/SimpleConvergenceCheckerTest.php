<?php

namespace Tests\Services;

use App\Services\SimpleConvergenceChecker;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimpleConvergenceCheckerTest extends TestCase
{
    private SimpleConvergenceChecker $convergenceChecker;

    protected function setUp(): void
    {
        $this->convergenceChecker = new SimpleConvergenceChecker();
    }

    public function testCheck()
    {
        self::assertTrue($this->convergenceChecker->check(new Population()));
    }
}
