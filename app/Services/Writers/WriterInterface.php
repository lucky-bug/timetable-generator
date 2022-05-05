<?php

namespace App\Services\Writers;

interface WriterInterface
{
    public function write(string $text): void;
}
