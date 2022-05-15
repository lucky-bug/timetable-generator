<?php

namespace Core;

interface SelectionMethodInterface
{
    public function select(Population $population): Population;
}
