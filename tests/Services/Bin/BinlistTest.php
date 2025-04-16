<?php

namespace Tests\Services\Bin;

use App\HttpClient;
use App\Services\Bin\Binlist;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BinlistTest extends TestCase
{
    private HttpClient&MockObject $httpMock;

    public function setUp(): void
    {
        $this->httpMock = $this->createMock(HttpClient::class);
    }

    public function testHttpException(): void
    {
        $this->httpMock->method('get')->willThrowException(new \Exception('test'));

        $bin = new Binlist('test', $this->httpMock);

        $this->expectException(\Exception::class);

        $bin->get(1);
    }

    public function testGetBinDto(): void
    {
        $this->httpMock->method('get')->willReturn(file_get_contents(__DIR__ . '/../../Data/binResponse.json'));

        $bin = new Binlist('test', $this->httpMock);

        $binDto = $bin->get(45717360);

        $this->assertSame('DK', $binDto->alpha2);
    }
}
