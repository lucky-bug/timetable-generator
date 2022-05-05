<?php

namespace Core;

interface ConvergenceCheckerInterface
{
    public function check(Population $population): bool;
}
