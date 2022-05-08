<?php

namespace Tests\Services\Algorithms\Mutation;

use App\Services\Algorithms\Mutation\SimpleIndividualMutationAlgorithm;
use App\Services\Generators\RandomNumberGeneratorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;
use PHPUnit\Framework\TestCase;

class SimpleIndividualMutationAlgorithmTest extends TestCase
{
    private const EXAMPLE_MUTATION_RATE = .5;

    /**
     * @var RandomNumberGeneratorInterface|MockObject
     */
    private $mockedRandomNumberGenerator;
    private SimpleIndividualMutationAlgorithm $individualMutationAlgorithm;

    protected function setUp(): void
    {
        $this->mockedRandomNumberGenerator = $this->createMock(RandomNumberGeneratorInterface::class);
        $this->individualMutationAlgorithm = new SimpleIndividualMutationAlgorithm(
            $this->mockedRandomNumberGenerator,
            self::EXAMPLE_MUTATION_RATE
        );
    }

    public function provideTestMutate(): array
    {
        return [
            ['0000', '0101'],
            ['0000', '1001'],
            ['00000000', '01001001'],
            ['00000000', '11001101'],
        ];
    }

    /**
     * @dataProvider provideTestMutate
     */
    public function testMutate(string $individual, string $mutant)
    {
        $this
            ->mockedRandomNumberGenerator
            ->expects(new InvokedCount(strlen($individual)))
            ->method('generateFloat')
            ->willReturnOnConsecutiveCalls(
                ...array_map(
                    fn (string $gene) => (intval($gene) + 1) % 2,
                    str_split($mutant)
                )
            )
        ;

        self::assertEquals($mutant, $this->individualMutationAlgorithm->mutate($individual));
    }
}
