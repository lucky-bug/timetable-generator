<?php

namespace Tests;

use App\SimpleSelectionAlgorithm;
use Core\Population;
use PHPUnit\Framework\TestCase;

class SimpleSelectionAlgorithmTest extends TestCase
{
    private SimpleSelectionAlgorithm $selectionAlgorithm;

    protected function setUp(): void
    {
        $this->selectionAlgorithm = new SimpleSelectionAlgorithm();
    }

    public function testSelect()
    {
        self::assertEquals(new Population(), $this->selectionAlgorithm->select(new Population()));
    }
}
