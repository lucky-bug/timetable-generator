<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Kernel;
use App\Services\Algorithms\Reproduction\SimpleReproductionAlgorithm;
use App\Services\Algorithms\Selection\SimpleSelectionAlgorithm;
use App\Services\SimpleConvergenceChecker;
use App\Services\Writers\SimpleWriter;

$app = new Kernel(
    new SimpleSelectionAlgorithm(),
    new SimpleReproductionAlgorithm(),
    new SimpleConvergenceChecker(),
    new SimpleWriter('php://stdout')
);

return $app;
