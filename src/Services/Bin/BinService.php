<?php

namespace App\Services\Bin;

use App\DTO\BinDTO;

class BinService
{
    public function __construct(private string $urlBinList)
    {
    }

    public function handle(int $bin): BinDTO
    {
        $binProvider = BinFactory::create($this->urlBinList);

        return $binProvider->get($bin);
    }
}