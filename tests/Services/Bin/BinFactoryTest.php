<?php

namespace Tests\Services\Bin;

use App\Services\Bin\BinFactory;
use App\Services\Bin\Binlist;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class BinFactoryTest extends TestCase
{
    public function testShouldReturnProvider(): void
    {
        $provider = BinFactory::create('https://binlist.io');

        $this->assertInstanceOf(BinList::class, $provider);
    }

    public function testUnknownProviderThrowsException(): void
    {
        $this->expectException(RuntimeException::class);

        BinFactory::create('https://test.io');
    }
}
