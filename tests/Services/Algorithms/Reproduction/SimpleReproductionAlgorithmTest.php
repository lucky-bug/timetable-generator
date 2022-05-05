<?php

namespace Tests\Services\Algorithms\Reproduction;

use App\Services\Algorithms\Reproduction\SimpleReproductionAlgorithm;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimpleReproductionAlgorithmTest extends TestCase
{
    private SimpleReproductionAlgorithm $reproductionAlgorithm;

    protected function setUp(): void
    {
        $this->reproductionAlgorithm = new SimpleReproductionAlgorithm();
    }

    public function testReproduce()
    {
        self::assertEquals(new Population(), $this->reproductionAlgorithm->reproduce(new Population()));
    }
}
