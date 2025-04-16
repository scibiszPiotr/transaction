<?php

namespace Tests;

use App\App;
use App\CalculateAmountFixed;
use App\DTO\BinDTO;
use App\DTO\ExchangeRatesDTO;
use App\DTO\TransactionCollection;
use App\DTO\TransactionDTO;
use App\Services\Bin\BinService;
use App\Services\Rate\RateService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    private BinService&MockObject $binService;
    private RateService&MockObject $rateService;

    public function setUp(): void
    {
        $this->binService = $this->createMock(BinService::class);
        $this->rateService = $this->createMock(RateService::class);
    }

    public function testApp(): void
    {
        $this->binService->method('handle')->willReturn(new BinDTO('DK'));
        $this->rateService->method('handle')->willReturn(new ExchangeRatesDTO(['EUR' => 1]));

        $app = new App(
            $this->binService,
            $this->rateService,
            new CalculateAmountFixed(),
        );

        $collection = new TransactionCollection();
        $transaction = new TransactionDTO(
            1,
            100,
            'EUR'
        );
        $collection->add($transaction);
        $transaction = new TransactionDTO(
            1,
            200,
            'EUR'
        );
        $collection->add($transaction);

        ob_start();

        $app($collection);

        $output = ob_get_clean();

        $this->assertEquals("1\n2\n", $output);
    }

    public function testEmptyTransactionList(): void
    {
        $app = new App(
            $this->binService,
            $this->rateService,
            new CalculateAmountFixed(),
        );

        $collection = new TransactionCollection();

        ob_start();

        $app($collection);

        $output = ob_get_clean();

        $this->assertEquals('', $output);
    }
}
