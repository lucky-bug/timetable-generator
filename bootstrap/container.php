<?php

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions(__DIR__ . '/../configs/genetics.php');
$containerBuilder->addDefinitions(__DIR__ . '/../configs/io.php');
$containerBuilder->addDefinitions(__DIR__ . '/../configs/app.php');

try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
    fwrite(STDERR,$e->getMessage() . PHP_EOL);
    exit(1);
}

return $container;
