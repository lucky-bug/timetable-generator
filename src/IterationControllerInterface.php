<?php

namespace Core;

interface IterationControllerInterface
{
    public function shouldContinue(Population $population): bool;
}
