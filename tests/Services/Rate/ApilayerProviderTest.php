<?php

namespace Tests\Services\Rate;

use App\HttpClient;
use App\Services\Rate\ApilayerProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApilayerProviderTest extends TestCase
{
    private HttpClient&MockObject $httpMock;

    public function setUp(): void
    {
        $this->httpMock = $this->createMock(HttpClient::class);
    }

    public function testHttpException(): void
    {
        $this->httpMock->method('get')->willThrowException(new \Exception('test'));

        $apilayerProvider = new ApilayerProvider('test', 'token', $this->httpMock);

        $this->expectException(\Exception::class);

        $apilayerProvider->get();
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetRates(string $currency, ?float $rate): void
    {
        $this->httpMock->method('get')->willReturn(file_get_contents(__DIR__ . '/../../Data/rateResponse.json'));

        $apilayerProvider = new ApilayerProvider('test', 'token', $this->httpMock);

        $rateDTO = $apilayerProvider->get();

        $this->assertSame($rate, $rateDTO->getRateByCurrency($currency));
    }

    public static function dataProvider(): array
    {
        return [
            [
                'SZL', 21.434172
            ],
            [
                'ZZZ', null
            ],
            [
                'PLN', 4.280111
            ]
        ];
    }
}