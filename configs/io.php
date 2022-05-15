<?php

use App\Services\IO\Readers\CsvReader;
use App\Services\IO\Readers\ReaderInterface;
use App\Services\IO\Writers\SimpleWriter;
use App\Services\IO\Writers\WriterInterface;
use function DI\autowire;
use function DI\get;

return [
    CsvReader::class => autowire(CsvReader::class)->constructorParameter('separator', ';'),
    ReaderInterface::class => get(CsvReader::class),
    SimpleWriter::class => get(SimpleWriter::class),
    WriterInterface::class => autowire(SimpleWriter::class)
        ->constructorParameter('filename', 'php://stdout'),
];
