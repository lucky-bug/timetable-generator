<?php

namespace App;

use Core\IndividualWriterInterface;

class SimpleIndividualWriter implements IndividualWriterInterface
{
    public function write(string $individual): void
    {
        echo $individual . PHP_EOL;
    }
}
