<?php

namespace Tests\Services\Writers;

use App\Services\Writers\SimpleWriter;
use PHPUnit\Framework\TestCase;

class SimpleWriterTest extends TestCase
{
    private string $filename;
    private SimpleWriter $writer;

    protected function setUp(): void
    {
        $this->filename = tempnam(sys_get_temp_dir(), 'phpunit_');
        $this->writer = new SimpleWriter($this->filename);
    }

    public function provideTestWrite(): array
    {
        return [
            ['00'],
            ['01'],
            ['10'],
            ['11'],
        ];
    }

    /**
     * @dataProvider provideTestWrite
     */
    public function testWrite(string $text): void
    {
        $this->writer->write($text);

        self::assertEquals(sprintf("%s\n", $text), file_get_contents($this->filename));
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }
}
