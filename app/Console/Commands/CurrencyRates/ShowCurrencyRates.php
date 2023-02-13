<?php

declare(strict_types=1);

namespace App\Console\Commands\CurrencyRates;

use App\Infrastructure\CurrencyRates\CurrencyRatesProvider;
use Illuminate\Console\Command;

class ShowCurrencyRates extends Command
{
    protected $signature = 'currency-rates:show {code : The code of currency}';
    protected $description = 'Отобразить котировки валют';

    public function handle(CurrencyRatesProvider $provider, ValuteFormatter $formatter): void
    {
        $code = $this->argument('code');

        foreach ($provider->getCurrencyRates() as $valute) {
            if ($valute->charCode === $code) {
                $this->info($formatter->format($valute));
            }
        }
    }
}
