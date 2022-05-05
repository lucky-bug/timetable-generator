<?php

namespace Tests\Services\Readers;

use App\Services\Readers\CsvReader;
use DateTime;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    private string $filename;
    private CsvReader $reader;

    protected function setUp(): void
    {
        $this->filename = tempnam(sys_get_temp_dir(), 'phpunit_' . date_timestamp_get(new DateTime()));
        $this->reader = new CsvReader();
    }

    public function provideTestRead(): array
    {
        return [
            [
                "a\nb",
                false,
                [
                    ['a'],
                    ['b'],
                ],
            ],
            [
                "a\nb",
                true,
                [
                    ['a' => 'b'],
                ],
            ],
            [
                "a,b\nc,d",
                false,
                [
                    ['a', 'b'],
                    ['c', 'd'],
                ],
            ],
            [
                "x,y\n1,2\n3,4",
                true,
                [
                    ['x' => '1', 'y' => '2'],
                    ['x' => '3', 'y' => '4'],
                ],
            ],
        ];
    }

    /**
     * @dataProvider provideTestRead
     */
    public function testRead(
        string $content,
        bool $firstLineHeader,
        array $expectedResult
    ): void {
        $this->reader->setFirstLineHeader($firstLineHeader);
        file_put_contents($this->filename, $content);
        self::assertEquals($expectedResult, $this->reader->read($this->filename));
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }
}
