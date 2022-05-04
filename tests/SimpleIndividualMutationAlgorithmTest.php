<?php

namespace Tests;

use App\SimpleIndividualMutationAlgorithm;
use PHPUnit\Framework\TestCase;

class SimpleIndividualMutationAlgorithmTest extends TestCase
{
    private SimpleIndividualMutationAlgorithm $individualMutationAlgorithm;

    protected function setUp(): void
    {
        $this->individualMutationAlgorithm = new SimpleIndividualMutationAlgorithm();
    }

    public function testMutate()
    {
        $individual = '0000';

        self::assertEquals($individual, $this->individualMutationAlgorithm->mutate($individual));
    }
}
