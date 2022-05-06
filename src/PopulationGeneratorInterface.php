<?php

namespace Core;

interface PopulationGeneratorInterface
{
    public function generate(int $size): Population;
}
