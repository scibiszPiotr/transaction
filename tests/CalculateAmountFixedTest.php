<?php

namespace Tests;

use App\CalculateAmountFixed;
use App\DTO\ExchangeRatesDTO;
use App\DTO\TransactionDTO;
use PHPUnit\Framework\TestCase;

class CalculateAmountFixedTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testReturnAmountFixed(bool $isEu, TransactionDTO $transactionDTO, ExchangeRatesDTO $exchangeRatesDTO, float $result): void
    {
        $calculator = new CalculateAmountFixed();

        $this->assertSame($result, $calculator->handle($isEu, $transactionDTO, $exchangeRatesDTO));
    }

    public function testNoRate(): void
    {
        $calculator = new CalculateAmountFixed();

        $this->expectExceptionMessage('Rate for currency USD is too small');

        $response = $calculator->handle(false, new TransactionDTO(
            45717360,
            100.00,
            'USD'
        ), new ExchangeRatesDTO([]));
    }

    public function dataProvider(): array
    {
        return [
            [
                'isEu' => true,
                'transactionDTO' => new TransactionDTO(
                    45717360,
                    100.00,
                    'EUR'
                ),
                'exchangeRatesDTO' => new ExchangeRatesDTO(['EUR' => 1, 'USD' => 1.136951]),
                'result' => 1,
            ],
            [
                'isEu' => true,
                'transactionDTO' => new TransactionDTO(
                    45717360,
                    100,
                    'EUR'
                ),
                'exchangeRatesDTO' => new ExchangeRatesDTO(['EUR' => 1, 'USD' => 1.136951]),
                'result' => 1,
            ],
            [
                'isEu' => true,
                'transactionDTO' => new TransactionDTO(
                    516793,
                    50.00,
                    'USD'
                ),
                'exchangeRatesDTO' => new ExchangeRatesDTO(['EUR' => 1, 'USD' => 1.06951]),
                'result' => 0.47,
            ],
            [
                'isEu' => false,
                'transactionDTO' => new TransactionDTO(
                    45417360,
                    10000.00,
                    'JPY'
                ),
                'exchangeRatesDTO' => new ExchangeRatesDTO(['EUR' => 1, 'USD' => 1.06951, 'JPY' => 120.868622]),
                'result' => 1.66,
            ],
            [
                'isEu' => false,
                'transactionDTO' => new TransactionDTO(
                    45417360,
                    10000.00,
                    'JPY'
                ),
                'exchangeRatesDTO' => new ExchangeRatesDTO(['EUR' => 1, 'USD' => 1.06951, 'JPY' => 0]),
                'result' => 200,
            ],
            [
                'isEu' => true,
                'transactionDTO' => new TransactionDTO(
                    45717360,
                    1000,
                    'USD'
                ),
                'exchangeRatesDTO' => new ExchangeRatesDTO(['EUR' => 1, 'USD' => 0.0]),
                'result' => 10,
            ],
        ];
    }
}
