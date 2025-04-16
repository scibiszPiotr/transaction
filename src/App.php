<?php

namespace App;

use App\DTO\TransactionCollection;
use App\DTO\TransactionDTO;
use App\Services\Bin\BinService;
use App\Services\Rate\RateService;

class App
{
    public function __construct(
        private BinService $binService,
        private RateService $rateService,
        private CalculateAmountFixed $calculator
    ) {
    }

    public function __invoke(TransactionCollection $transactions): void
    {
        /** @var TransactionDTO $transaction */
        foreach ($transactions as $transaction) {
            $binDTO = $this->binService->handle($transaction->bin);
            $rateDTO = $this->rateService->handle();

            $result = $this->calculator->handle(
                EuropeanUnion::isEuCountry($binDTO->alpha2),
                $transaction,
                $rateDTO
            );

            echo $result . PHP_EOL;
        }
    }
}