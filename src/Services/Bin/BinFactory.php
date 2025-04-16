<?php

namespace App\Services\Bin;

use App\HttpClient;
use GuzzleHttp\Client;
use RuntimeException;

class BinFactory
{
    public static function create(string $url): BinProviderStrategy
    {
        /** I didn't create a DI pattern to keep the code small */
        return match (true) {
            str_contains($url, 'binlist') => new BinList($url, new HttpClient(new Client())),
            default => throw new RuntimeException('Unknown type'),
        };
    }
}