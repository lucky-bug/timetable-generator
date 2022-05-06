<?php

namespace App\Services\Loaders;

interface LoaderInterface
{
    public function load(string $filename): void;
    public function getDataClass(): string;
}
