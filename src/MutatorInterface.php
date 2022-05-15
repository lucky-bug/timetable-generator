<?php

namespace Core;

interface MutatorInterface
{
    public function mutate(string $individual): string;
}
