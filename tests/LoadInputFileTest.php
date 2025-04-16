<?php

namespace Tests;

use App\LoadInputFile;
use PHPUnit\Framework\TestCase;

class LoadInputFileTest extends TestCase
{
    public function testLoadInputFile(): void
    {
        $loader = new LoadInputFile();

        $collection = $loader->load(__DIR__ . '/Data/input.txt');

        $this->assertCount(5, $collection);
    }

    public function testLoadInputFileWithEmptyLine(): void
    {
        $loader = new LoadInputFile();

        $collection = $loader->load(__DIR__ . '/Data/input_empty_line.txt');

        $this->assertCount(5, $collection);
    }

    public function testDataFromJsonToDto(): void
    {
        $loader = new LoadInputFile();

        $collection = $loader->load(__DIR__ . '/Data/input.txt');

        $transactionDto = $collection->first();

        $this->assertSame(45717360, $transactionDto->bin);
        $this->assertSame(100.00, $transactionDto->amount);
        $this->assertSame('EUR', $transactionDto->currency);
    }
}
