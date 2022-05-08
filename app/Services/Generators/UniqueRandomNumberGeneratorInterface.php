<?php

namespace App\Services\Generators;

interface UniqueRandomNumberGeneratorInterface extends RandomNumberGeneratorInterface
{
    public function reset(): void;
}
