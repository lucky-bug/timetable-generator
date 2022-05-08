<?php

namespace Tests\Services\Generators;

use App\Services\Generators\RandomNumberGeneratorInterface;
use App\Services\Generators\SimpleUniqueRandomNumberGenerator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;
use PHPUnit\Framework\TestCase;

class SimpleUniqueRandomNumberGeneratorTest extends TestCase
{
    private const ASSERTIONS = 100;

    /**
     * @var RandomNumberGeneratorInterface|MockObject
     */
    private $mockedRandomNumberGenerator;
    private SimpleUniqueRandomNumberGenerator $generator;

    protected function setUp(): void
    {
        $this->mockedRandomNumberGenerator = $this->createMock(RandomNumberGeneratorInterface::class);
        $this->generator = new SimpleUniqueRandomNumberGenerator(
            $this->mockedRandomNumberGenerator
        );
    }

    public function testGenerateInt(): void
    {
        $this
            ->mockedRandomNumberGenerator
            ->expects(new InvokedCount(10))
            ->method('generateInt')
            ->willReturnOnConsecutiveCalls(1, 1, 2, 2, 2, 3, 3, 3, 3, 4)
        ;

        foreach ([1, 2, 3, 4] as $value) {
            self::assertEquals($value, $this->generator->generateInt(1, 4));
        }
    }

    public function testGenerateFloat(): void
    {
        $this
            ->mockedRandomNumberGenerator
            ->expects(new InvokedCount(10))
            ->method('generateFloat')
            ->willReturnOnConsecutiveCalls(.1, .1, .2, .2, .2, .3, .3, .3, .3, .4)
        ;

        foreach ([.1, .2, .3, .4] as $value) {
            self::assertEquals($value, $this->generator->generateFloat(.1, .4));
        }
    }

    public function testReset(): void
    {
        $this
            ->mockedRandomNumberGenerator
            ->expects(new InvokedCount(11))
            ->method('generateInt')
            ->willReturnOnConsecutiveCalls(1, 1, 2, 2, 2, 3, 3, 3, 3, 4, 4)
        ;

        foreach ([1, 2, 3, 4] as $value) {
            self::assertEquals($value, $this->generator->generateInt(1, 4));
        }

        $this->generator->reset();

        self::assertEquals(4, $this->generator->generateInt(1, 4));

        $this
            ->mockedRandomNumberGenerator
            ->expects(new InvokedCount(11))
            ->method('generateFloat')
            ->willReturnOnConsecutiveCalls(.1, .1, .2, .2, .2, .3, .3, .3, .3, .4, .4)
        ;

        foreach ([.1, .2, .3, .4] as $value) {
            self::assertEquals($value, $this->generator->generateFloat(.1, .4));
        }

        $this->generator->reset();

        self::assertEquals(.4, $this->generator->generateFloat(.1, .4));
    }
}
