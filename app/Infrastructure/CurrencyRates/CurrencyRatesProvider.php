<?php

declare(strict_types=1);

namespace App\Infrastructure\CurrencyRates;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class CurrencyRatesProvider
{
    public function __construct(
        private readonly ClientInterface $httpClient,
    ) {
    }

    /**
     * @return array<ValuteDTO>
     *
     * @throws ClientExceptionInterface
     */
    public function getCurrencyRates(): array
    {
        $request = new Request('GET', 'https://cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y'));

        $response = $this->httpClient->sendRequest($request);

        $xml = new \DOMDocument();
        $xml->loadXML($response->getBody()->getContents());

        $result = [];
        foreach ($xml->getElementsByTagName('Valute') as $valute) {
            $result[] = new ValuteDTO(
                (string) $valute->getAttribute('ID'),
                (string) $valute->getElementsByTagName('NumCode')->item(0)->nodeValue,
                (string) $valute->getElementsByTagName('CharCode')->item(0)->nodeValue,
                (int) $valute->getElementsByTagName('Nominal')->item(0)->nodeValue,
                (string) $valute->getElementsByTagName('Name')->item(0)->nodeValue,
                (float) $valute->getElementsByTagName('Value')->item(0)->nodeValue,
            );
        }

        return $result;
    }
}
