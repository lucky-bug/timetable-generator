<?php

use App\Services\Loaders\ClassroomsLoader;
use App\Services\Loaders\LessonsLoader;
use DI\Container;

/** @var Container $container */
$container = require __DIR__ . '/container.php';

//$container->get(ClassroomsLoader::class)->load(__DIR__ . '/../resources/classrooms.csv');
$container->get(ClassroomsLoader::class)->load(__DIR__ . '/../resources/all_classrooms.csv');
//$container->get(LessonsLoader::class)->load(__DIR__ . '/../resources/lessons.csv');
$container->get(LessonsLoader::class)->load(__DIR__ . '/../resources/all_lessons.csv');

return $container;
