<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Kernel;
use App\Services\Algorithms\Reproduction\SimpleReproductionAlgorithm;
use App\Services\Algorithms\Selection\SimpleSelectionAlgorithm;
use App\Services\SimpleIterationBreaker;
use App\Services\Writers\SimpleWriter;

$app = new Kernel(
    new SimpleSelectionAlgorithm(),
    new SimpleReproductionAlgorithm(),
    new SimpleIterationBreaker(),
    new SimpleWriter('php://stdout')
);

return $app;
