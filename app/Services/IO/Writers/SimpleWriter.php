<?php

namespace App\Services\IO\Writers;

class SimpleWriter implements WriterInterface
{
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function write(string $text): void
    {
        $file = fopen($this->filename, 'w');
        fprintf($file, "%s", $text);
        fclose($file);
    }

    public function writeLine(string $text): void
    {
        $file = fopen($this->filename, 'w');
        fprintf($file, "%s\n", $text);
        fclose($file);
    }
}
