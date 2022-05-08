<?php

namespace Tests\Services;

use App\Services\SimpleConvergenceChecker;
use Core\FitnessCalculatorInterface;
use Core\Population;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;
use PHPUnit\Framework\TestCase;

class SimpleConvergenceCheckerTest extends TestCase
{
    /**
     * @var FitnessCalculatorInterface|MockObject
     */
    private $mockedFitnessCalculator;
    private SimpleConvergenceChecker $convergenceChecker;

    protected function setUp(): void
    {
        $this->mockedFitnessCalculator = $this->createMock(FitnessCalculatorInterface::class);
        $this->convergenceChecker = new SimpleConvergenceChecker(
            $this->mockedFitnessCalculator,
            1
        );
    }

    public function testCheck()
    {
        $population = new Population();
        $population->add('');

        $this
            ->mockedFitnessCalculator
            ->expects(new InvokedCount(2))
            ->method('calculate')
            ->willReturn(0, 1)
        ;

        self::assertFalse($this->convergenceChecker->check($population));
        self::assertTrue($this->convergenceChecker->check($population));
    }
}
