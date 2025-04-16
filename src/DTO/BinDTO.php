<?php

namespace App\DTO;

readonly class BinDTO
{
    public function __construct(
        public string $alpha2,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['country']['alpha2'] ?? '',
        );
    }
}