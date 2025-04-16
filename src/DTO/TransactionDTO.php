<?php

namespace App\DTO;

readonly class TransactionDTO
{
    public function __construct(
        public int $bin,
        public float $amount,
        public string $currency
    ) {
    }
}