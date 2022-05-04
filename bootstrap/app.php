<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Kernel;
use App\SimpleIndividualWriter;
use App\SimpleIterationBreaker;
use App\SimpleReproductionAlgorithm;
use App\SimpleSelectionAlgorithm;

$app = new Kernel(
    new SimpleSelectionAlgorithm(),
    new SimpleReproductionAlgorithm(),
    new SimpleIterationBreaker(),
    new SimpleIndividualWriter('php://stdout')
);

return $app;
