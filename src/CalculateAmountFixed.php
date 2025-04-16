<?php

namespace App;

use App\DTO\ExchangeRatesDTO;
use App\DTO\TransactionDTO;

class CalculateAmountFixed
{
    private const string EUR = 'EUR';
    private const float EU_FIX_RATE = 0.01;
    private const float GLOBAL_FIX_RATE = 0.02;

    public function handle(bool $isEu, TransactionDTO $transactionDTO, ExchangeRatesDTO $exchangeRatesDTO): float
    {
        $amount = $this->getAmount($transactionDTO, $exchangeRatesDTO);

        $amountFixed = $amount * ($isEu ? self::EU_FIX_RATE : self::GLOBAL_FIX_RATE);

        return $this->roundUpTwoDecimals($amountFixed);
    }

    private function roundUpTwoDecimals(float $number): float
    {
        return ceil($number * 100) / 100;
    }

    private function getAmount(TransactionDTO $transactionDTO, ExchangeRatesDTO $exchangeRatesDTO): float
    {
        if ($transactionDTO->currency === self::EUR) {
            return $transactionDTO->amount;
        }

        if ($exchangeRatesDTO->getRateByCurrency($transactionDTO->currency) === 0.0) {
            return $transactionDTO->amount;
        }

        if (($rate = $exchangeRatesDTO->getRateByCurrency($transactionDTO->currency)) > 0) {
            return $transactionDTO->amount / $rate;
        }

        throw new \Exception(sprintf('Rate for currency %s is too small', $transactionDTO->currency));
    }
}