<?php

namespace App;

use Core\IndividualWriterInterface;

class SimpleIndividualWriter implements IndividualWriterInterface
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function write(string $individual): void
    {
        file_put_contents($this->filename, sprintf("%s\n", $individual));
    }
}
