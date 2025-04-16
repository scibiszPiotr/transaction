<?php

namespace App\Services\Rate;

use App\HttpClient;
use GuzzleHttp\Client;
use RuntimeException;

class RateFactory
{
    public static function create(string $url, string $token): RateProviderStrategy
    {
        /** I didn't create a DI pattern to keep the code small */
        return match (true) {
            str_contains($url, 'apilayer') => new ApilayerProvider($url, $token, new HttpClient(new Client())),
            default => throw new RuntimeException('Unknown rate provider'),
        };
    }
}