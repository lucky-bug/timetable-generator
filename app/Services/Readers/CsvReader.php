<?php

namespace App\Services\Readers;

class CsvReader implements ReaderInterface
{
    private bool $firstLineHeader;

    public function __construct(bool $firstLineHeader = false)
    {
        $this->firstLineHeader = $firstLineHeader;
    }

    public function read(string $source): array
    {
        $result = [];
        $file = fopen($source, 'r');
        $headers = $this->firstLineHeader ? fgetcsv($file) : null;

        while ($data = fgetcsv($file)) {
            $result[] = $headers === null ? $data : array_combine($headers, $data);
        }

        fclose($file);

        return $result;
    }

    public function isFirstLineHeader(): bool
    {
        return $this->firstLineHeader;
    }

    public function setFirstLineHeader(bool $firstLineHeader): self
    {
        $this->firstLineHeader = $firstLineHeader;

        return $this;
    }
}
