<?php

namespace Tests\Services\Algorithms\Reproduction;

use App\Services\Algorithms\Reproduction\SimpleReproductionAlgorithm;
use App\Services\Generators\SimpleRandomNumberGenerator;
use App\Services\Generators\SimpleUniqueRandomNumberGenerator;
use Core\IndividualMutationAlgorithmInterface;
use Core\Population;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SimpleReproductionAlgorithmTest extends TestCase
{
    /**
     * @var IndividualMutationAlgorithmInterface|MockObject
     */
    private $mockedIndividualMutationAlgorithm;
    private SimpleReproductionAlgorithm $reproductionAlgorithm;

    protected function setUp(): void
    {
        $this->mockedIndividualMutationAlgorithm = $this->createMock(IndividualMutationAlgorithmInterface::class);
        $this->reproductionAlgorithm = new SimpleReproductionAlgorithm(
            new SimpleUniqueRandomNumberGenerator(new SimpleRandomNumberGenerator()),
            new SimpleRandomNumberGenerator(),
            $this->mockedIndividualMutationAlgorithm,
            4
        );
    }

    public function testReproduce()
    {
        $this
            ->mockedIndividualMutationAlgorithm
            ->method('mutate')
            ->willReturn('1111')
        ;

        $initialPopulation = new Population();
        $initialPopulation->add('0000');
        $initialPopulation->add('0000');

        $finalPopulation = clone $initialPopulation;
        $finalPopulation->add('1111');
        $finalPopulation->add('1111');

        self::assertEquals($finalPopulation, $this->reproductionAlgorithm->reproduce($initialPopulation));
    }
}
