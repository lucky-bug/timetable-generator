<?php

namespace Core;

interface IndividualWriterInterface
{
    public function write(string $individual): void;
}
