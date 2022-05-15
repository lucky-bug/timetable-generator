<?php

namespace App\Services\IO\Readers;

interface ReaderInterface
{
    public function read(string $source): array;
}
