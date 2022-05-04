<?php

namespace Core;

interface IterationBreakerInterface
{
    public function check(Population $population): bool;
}
