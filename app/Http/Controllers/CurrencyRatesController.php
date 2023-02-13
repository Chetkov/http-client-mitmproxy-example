<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Formatters\CurrencyRates\ValuteFormatter;
use App\Infrastructure\CurrencyRates\CurrencyRatesProvider;
use Psr\Http\Client\ClientExceptionInterface;

class CurrencyRatesController extends Controller
{
    /**
     * @param string $code
     * @param CurrencyRatesProvider $provider
     * @param ValuteFormatter $formatter
     *
     * @return array
     *
     * @throws ClientExceptionInterface
     */
    public function getCurrencyRate(string $code, CurrencyRatesProvider $provider, ValuteFormatter $formatter): array
    {
        foreach ($provider->getCurrencyRates() as $valute) {
            if ($valute->charCode === $code) {
                return $formatter->format($valute);
            }
        }

        return [];
    }

    /**
     * @param CurrencyRatesProvider $provider
     * @param ValuteFormatter $formatter
     *
     * @return array
     *
     * @throws ClientExceptionInterface
     */
    public function getCurrencyRates(CurrencyRatesProvider $provider, ValuteFormatter $formatter): array
    {
        return $formatter->formatMany(...$provider->getCurrencyRates());
    }
}
