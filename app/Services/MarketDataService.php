<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class MarketDataService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = env('TWELVEDATA_API_KEY', 'demo');
    }

    public function getQuotes(): array
    {
        // Cache the result for 5 minutes (300 seconds) to avoid hitting rate limits easily
        return Cache::remember('market_data_quotes', 300, function () {

            $symbols = 'EUR/USD,XAU/USD,BTC/EUR,ETH/EUR,SOL/EUR';

            try {
                $response = Http::get("https://api.twelvedata.com/quote", [
                    'symbol' => $symbols,
                    'apikey' => $this->apiKey,
                ]);

                if ($response->successful()) {
                    $data = $response->json();

                    // Format response into stable standard structure for Next.js
                    return $this->formatQuotes($data);
                }
            } catch (Exception $e) {
                // Empty cache if fails so next reload tries again.
            }

            // Fallback mock data structure if API fails or no API key provided
            return $this->getFallbackData();
        });
    }

    private function formatQuotes(array $data): array
    {
        $formatted = [];

        $mapping = [
            'EUR/USD' => ['label' => 'EUR/USD', 'prefix' => '', 'decimals' => 4],
            'XAU/USD' => ['label' => 'ALTIN/ONS', 'prefix' => '$', 'decimals' => 2],
            'BTC/EUR' => ['label' => 'BTC/EUR', 'prefix' => '€', 'decimals' => 2],
            'ETH/EUR' => ['label' => 'ETH/EUR', 'prefix' => '€', 'decimals' => 2],
            'SOL/EUR' => ['label' => 'SOL/EUR', 'prefix' => '€', 'decimals' => 2],
        ];

        foreach ($mapping as $symbol => $meta) {
            if (isset($data[$symbol])) {
                $quote = $data[$symbol];
                $close = (float) ($quote['close'] ?? 0);
                $change = (float) ($quote['percent_change'] ?? 0);

                $formatted[] = [
                    'id' => $symbol,
                    'label' => $meta['label'],
                    'value' => $meta['prefix'] . number_format($close, $meta['decimals'], '.', ','),
                    'change' => number_format(abs($change), 2, '.', ''),
                    'isPositive' => $change >= 0
                ];
            } else {
                // Failover single fallback if one pair fails in payload
                $formatted[] = [
                    'id' => $symbol,
                    'label' => $meta['label'],
                    'value' => $meta['prefix'] . '0.00',
                    'change' => '0.00',
                    'isPositive' => true
                ];
            }
        }

        return $formatted;
    }

    private function getFallbackData(): array
    {
        return [
            ['id' => 'EUR/USD', 'label' => 'EUR/USD', 'value' => '-', 'change' => '0', 'isPositive' => true],
            ['id' => 'XAU/USD', 'label' => 'ALTIN/ONS', 'value' => '-', 'change' => '0', 'isPositive' => true],
            ['id' => 'BTC/EUR', 'label' => 'BTC/EUR', 'value' => '-', 'change' => '0', 'isPositive' => true],
            ['id' => 'ETH/EUR', 'label' => 'ETH/EUR', 'value' => '-', 'change' => '0', 'isPositive' => false],
            ['id' => 'SOL/EUR', 'label' => 'SOL/EUR', 'value' => '-', 'change' => '0', 'isPositive' => true],
        ];
    }
}
