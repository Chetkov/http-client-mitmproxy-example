<?php

declare(strict_types=1);

namespace App\Http\Formatters\CurrencyRates;

use App\Infrastructure\CurrencyRates\ValuteDTO;

class ValuteFormatter
{
    public function format(ValuteDTO $valute): array
    {
        return [
            'id' => $valute->id,
            'char_code' => $valute->charCode,
            'num_code' => $valute->numCode,
            'name' => $valute->name,
            'nominal' => $valute->nominal,
            'value' => $valute->value,
        ];
    }

    public function formatMany(ValuteDTO ...$valuteList): array
    {
        $result = [];
        foreach ($valuteList as $valute) {
            $result[] = $this->format($valute);
        }

        return $result;
    }
}
