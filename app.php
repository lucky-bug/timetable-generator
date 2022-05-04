<?php

require __DIR__ . '/vendor/autoload.php';

use App\Kernel;
use App\SimpleIndividualWriter;
use App\SimpleIterationBreaker;
use App\SimplePopulationGenerator;
use App\SimpleReproductionAlgorithm;
use App\SimpleSelectionAlgorithm;

$initialPopulationGenerator = new SimplePopulationGenerator();

$app = new Kernel(
    new SimpleSelectionAlgorithm(),
    new SimpleReproductionAlgorithm(),
    new SimpleIterationBreaker(),
    new SimpleIndividualWriter()
);

$app->handle($initialPopulationGenerator->generate());
