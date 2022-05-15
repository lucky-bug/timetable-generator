<?php

namespace Core;

interface ReproductionMethodInterface
{
    public function reproduce(Population $population): Population;
}
