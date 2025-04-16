<?php

namespace Tests\Services\Rate;

use App\Services\Rate\ApilayerProvider;
use App\Services\Rate\RateFactory;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class RateFactoryTest extends TestCase
{
    public function testShouldReturnProvider(): void
    {
        $provider = RateFactory::create('https://apilayer.io/api', 'token');

        $this->assertInstanceOf(ApilayerProvider::class, $provider);
    }

    public function testUnknownProviderThrowsException(): void
    {
        $this->expectException(RuntimeException::class);

        RateFactory::create('https://test.io/api', 'token');
    }
}
