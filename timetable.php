<?php

require __DIR__ . '/vendor/autoload.php';

use App\Services\IO\Writers\TimetableWriter;
use App\Services\Resolvers\LessonsResolver;
use DI\Container;

/** @var Container $container */
$container = require __DIR__ . '/bootstrap/app.php';

$resolver = $container->get(LessonsResolver::class);
$writer = $container->get(TimetableWriter::class);

// TODO: Check if $argv[1] is set
$writer->write($resolver->resolve($argv[1]), $container->get('weeksPerTimetable'), $container->get('daysPerTimetable'), $container->get('periodsPerTimetable'));
