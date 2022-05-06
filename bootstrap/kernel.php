<?php

use App\Kernel;
use App\Services\Algorithms\Reproduction\SimpleReproductionAlgorithm;
use App\Services\Algorithms\Selection\SimpleSelectionAlgorithm;
use App\Services\SimpleConvergenceChecker;
use App\Services\Writers\SimpleWriter;

$kernel = new Kernel(
    new SimpleSelectionAlgorithm(),
    new SimpleReproductionAlgorithm(),
    new SimpleConvergenceChecker(),
    new SimpleWriter('php://stdout')
);

return $kernel;
