<?php

namespace App\Services\Rate;

use App\DTO\ExchangeRatesDTO;

class RateService
{
    public function __construct(private string $urlExchangeratesApi, private string $token)
    {
    }

    public function handle(): ExchangeRatesDTO
    {
        $rateProvider = RateFactory::create($this->urlExchangeratesApi, $this->token);

        return $rateProvider->get();
    }
}