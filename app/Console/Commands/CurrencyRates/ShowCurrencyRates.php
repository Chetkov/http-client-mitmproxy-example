<?php

declare(strict_types=1);

namespace App\Console\Commands\CurrencyRates;

use App\Infrastructure\CurrencyRates\CurrencyRatesProvider;
use Illuminate\Console\Command;
use Psr\Http\Client\ClientExceptionInterface;

class ShowCurrencyRates extends Command
{
    protected $signature = 'currency-rates:show {code : The code of currency}';
    protected $description = 'Отобразить котировки валют';

    /**
     * @throws ClientExceptionInterface
     */
    public function handle(CurrencyRatesProvider $provider, ValuteFormatter $formatter): void
    {
        $code = $this->argument('code');
        if ($valute = $provider->getCurrencyRate(new \DateTimeImmutable(), $code)) {
            $this->info($formatter->format($valute));
        }
    }
}
