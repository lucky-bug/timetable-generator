<?php

namespace Core;

interface IndividualMutationAlgorithmInterface
{
    public function mutate(string $individual): string;
}
