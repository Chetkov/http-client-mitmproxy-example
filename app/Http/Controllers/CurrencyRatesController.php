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
        $valute = $provider->getCurrencyRate(new \DateTimeImmutable(), $code);

        return $valute ? $formatter->format($valute) : [];
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
        return $formatter->formatMany(...$provider->getCurrencyRates(new \DateTimeImmutable()));
    }
}
