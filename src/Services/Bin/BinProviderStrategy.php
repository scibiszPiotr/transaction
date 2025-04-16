<?php

namespace App\Services\Bin;

use App\DTO\BinDTO;

interface BinProviderStrategy
{
    public function get(int $bin): BinDTO;
}