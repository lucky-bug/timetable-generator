<?php

require __DIR__ . '/vendor/autoload.php';

use App\Kernel;
use App\Services\Generators\SimplePopulationGenerator;

/** @var Kernel $kernel */
$kernel = require __DIR__ . '/bootstrap/kernel.php';

$initialPopulationGenerator = new SimplePopulationGenerator();

$kernel->handle($initialPopulationGenerator->generate(10));
