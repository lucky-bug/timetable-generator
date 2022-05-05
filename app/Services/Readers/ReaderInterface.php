<?php

namespace App\Services\Readers;

interface ReaderInterface
{
    public function read(string $source): array;
}
