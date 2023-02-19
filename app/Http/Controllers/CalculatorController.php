<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function calculate(Request $request): array
    {
        $response = [];

        $currencyCodes = $request->input('codes');
        $amount = $request->input('rub');

        foreach ($currencyCodes as $code) {
            $result = file_get_contents("{$request->getScheme()}://{$request->getHost()}:8001" . '/currency-rates/' . $code);
            if ($result) {
                $data = json_decode($result, true);
                $response[] = [
                    'currency_code' => $code,
                    'amount_in_rub' => (int) $amount,
                    'amount_in_currency' => round($amount / $data['value'], 2),
                ];
            }
        }

        return $response;
    }
}
