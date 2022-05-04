<?php

$app = require __DIR__ . '/bootstrap/app.php';

use App\SimplePopulationGenerator;

$initialPopulationGenerator = new SimplePopulationGenerator();

$app->handle($initialPopulationGenerator->generate());
