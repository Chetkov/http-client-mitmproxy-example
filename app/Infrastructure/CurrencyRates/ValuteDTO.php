<?php

declare(strict_types=1);

namespace App\Infrastructure\CurrencyRates;

class ValuteDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $numCode,
        public readonly string $charCode,
        public readonly int $nominal,
        public readonly string $name,
        public readonly float $value,
    ) {
    }
}
