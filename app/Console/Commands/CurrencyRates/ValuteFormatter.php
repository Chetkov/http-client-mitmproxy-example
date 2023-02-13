<?php

declare(strict_types=1);

namespace App\Console\Commands\CurrencyRates;

use App\Infrastructure\CurrencyRates\ValuteDTO;

class ValuteFormatter
{
    public function format(ValuteDTO $valute): string
    {
        return 'ID: ' . $valute->id . PHP_EOL .
            'CHAR_CODE: ' . $valute->charCode . PHP_EOL .
            'NUM_CODE: ' . $valute->numCode . PHP_EOL .
            'NAME: ' . $valute->name . PHP_EOL .
            'NOMINAL: ' . $valute->nominal . PHP_EOL .
            'VALUE: ' . $valute->value . PHP_EOL;
    }
}
