<?php

namespace Tests\Services\Writers;

use App\Services\Writers\SimpleIndividualWriter;
use PHPUnit\Framework\TestCase;

class SimpleIndividualWriterTest extends TestCase
{
    private string $filename;
    private SimpleIndividualWriter $individualWriter;

    protected function setUp(): void
    {
        $this->filename = tempnam(sys_get_temp_dir(), 'phpunit_');
        $this->individualWriter = new SimpleIndividualWriter($this->filename);
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
    public function testWrite(string $individual): void
    {
        $this->individualWriter->write($individual);

        self::assertEquals(sprintf("%s\n", $individual), file_get_contents($this->filename));
    }

    protected function tearDown(): void
    {
        unlink($this->filename);
    }
}
