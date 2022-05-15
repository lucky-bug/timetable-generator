<?php

require __DIR__ . '/vendor/autoload.php';

use App\Services\IO\Writers\WriterInterface;
use Core\IteratorInterface;
use Core\PopulationGeneratorInterface;
use DI\Container;

/** @var Container $container */
$container = require __DIR__ . '/bootstrap/app.php';

$populationGenerator = $container->get(PopulationGeneratorInterface::class);
$iterator = $container->get(IteratorInterface::class);
$writer = $container->get(WriterInterface::class);

$initialPopulation = $populationGenerator->generate($container->get('populationSize'));
$finalPopulation = $iterator->iterate($initialPopulation);

$writer->writeLine($finalPopulation->get(0));
$writer->writeLine($iterator->getTotalIterations());
