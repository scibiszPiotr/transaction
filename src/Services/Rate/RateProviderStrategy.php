<?php

namespace App\Services\Rate;

use App\DTO\ExchangeRatesDTO;

interface RateProviderStrategy
{
    public function get(): ExchangeRatesDTO;
}
