<?php

namespace App\Services\Bin;

use App\DTO\BinDTO;
use App\HttpClient;

class Binlist implements BinProviderStrategy
{
    public function __construct(private string $urlBinList, private HttpClient $httpClient)
    {
    }

    public function get(int $bin): BinDTO
    {
        $binResultsJson = $this->httpClient->get($this->urlBinList . $bin);

        return BinDTO::fromArray(json_decode($binResultsJson, true));
    }
}