<?php

require __DIR__ . '/vendor/autoload.php';

use App\Services\Denormalizers\IndividualDenormalizer;
use App\Services\IO\Readers\CsvReader;
use App\Services\IO\Writers\WriterInterface;
use Core\IteratorInterface;
use Core\PopulationGeneratorInterface;
use DI\Container;

/** @var Container $container */
$container = require __DIR__ . '/bootstrap/app.php';

$populationGenerator = $container->get(PopulationGeneratorInterface::class);
$iterator = $container->get(IteratorInterface::class);
$csvReader = $container->get(CsvReader::class);
$writer = $container->get(WriterInterface::class);
$individualDenormalizer = $container->get(IndividualDenormalizer::class);

$startTime = new DateTime();
$writer->writeLine($startTime->format(DateTimeInterface::ATOM));

$initialPopulation = $populationGenerator->generate($container->get('populationSize'));

foreach ($csvReader->read('fittest_list.csv') as $data) {
    $individual = $individualDenormalizer->mapToEntity($data);
    $initialPopulation->addIndividual($individual);
}

$finalPopulation = $iterator->iterate($initialPopulation);

$writer->writeLine($finalPopulation->getIndividual(0)->getGenes());
$writer->writeLine($iterator->getTotalIterations());
