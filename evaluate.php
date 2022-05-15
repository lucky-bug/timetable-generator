<?php

require __DIR__ . '/vendor/autoload.php';

use App\Services\IO\Writers\WriterInterface;
use Core\EvaluatorInterface;
use DI\Container;

/** @var Container $container */
$container = require __DIR__ . '/bootstrap/app.php';

$evaluator = $container->get(EvaluatorInterface::class);
$writer = $container->get(WriterInterface::class);

// TODO: Check if $argv[1] is set
$writer->writeLine(sprintf("%d/%d", $evaluator->evaluate($argv[1]), $evaluator->getPerfectFitness()));
