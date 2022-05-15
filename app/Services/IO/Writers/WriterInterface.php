<?php

namespace App\Services\IO\Writers;

interface WriterInterface
{
    public function write(string $text): void;
    public function writeLine(string $text): void;
}
