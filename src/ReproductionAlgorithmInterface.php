<?php

namespace Core;

interface ReproductionAlgorithmInterface
{
    public function reproduce(Population $population): Population;
}
