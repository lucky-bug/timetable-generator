<?php

namespace App\Services\IO\Writers;

class SimpleRewritableWriter implements WriterInterface
{
    private string $filename;
    private int $totalBackspaces;

    public function __construct(string $filename)
    {
        $this->totalBackspaces = 0;
        $this->filename = $filename;
    }

    public function write(string $text): void
    {
        $file = fopen($this->filename, 'w');
        if ($this->totalBackspaces > 0) {
            fwrite($file, str_repeat(chr(8), $this->totalBackspaces));
        }
        fwrite($file, $text);
        fclose($file);
        $this->totalBackspaces = strlen($text);
    }

    public function writeLine(string $text): void
    {
        $file = fopen($this->filename, 'w');
        if ($this->totalBackspaces > 0) {
            fwrite($file, str_repeat(chr(8), $this->totalBackspaces));
        }
        fwrite($file, $text . PHP_EOL);
        fclose($file);
        $this->totalBackspaces = strlen($text) + 1;
    }
}
