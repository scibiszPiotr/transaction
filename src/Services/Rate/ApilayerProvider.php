<?php

namespace App\Services\Rate;

use App\DTO\ExchangeRatesDTO;
use App\HttpClient;

class ApilayerProvider implements RateProviderStrategy
{
    public function __construct(private string $url, private string $token, private HttpClient $httpClient)
    {
    }

    public function get(): ExchangeRatesDTO
    {
        $rateJson = $this->httpClient->get($this->url, ['headers' => ['Content-Type' => 'text/plain', 'apikey' => $this->token]]);

        return ExchangeRatesDTO::fromArray(json_decode($rateJson, true));
    }
}