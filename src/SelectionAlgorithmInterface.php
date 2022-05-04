<?php

namespace Core;

interface SelectionAlgorithmInterface
{
    public function select(Population $population): Population;
}
