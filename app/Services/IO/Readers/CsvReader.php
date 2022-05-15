<?php

namespace App\Services\IO\Readers;

class CsvReader implements ReaderInterface
{
    private bool $firstLineHeader;
    private string $separator;

    public function __construct(
        bool $firstLineHeader = false,
        string $separator = ','
    ) {
        $this->firstLineHeader = $firstLineHeader;
        $this->separator = $separator;
    }

    public function read(string $source): array
    {
        $result = [];
        $file = fopen($source, 'r');
        $headers = $this->firstLineHeader ? fgetcsv($file, null, $this->separator) : null;

        while ($data = fgetcsv($file, null, $this->separator)) {
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
