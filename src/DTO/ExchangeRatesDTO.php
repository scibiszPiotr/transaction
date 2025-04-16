<?php

namespace App\DTO;

readonly class ExchangeRatesDTO
{
    /** @var array<string, float> */
    public array $rates;

    public function __construct(array $rates) {
        $this->rates = $rates;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            array_map('floatval', $data['rates'] ?? [])
        );
    }

    public function getRateByCurrency(string $currency): ?float
    {
        return $this->rates[$currency] ?? null;
    }
}
