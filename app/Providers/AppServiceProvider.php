<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Veritabanından Settings çekip Config'e atama
        try {
            if (Schema::hasTable('settings')) {
                $settings = Cache::remember('settings', 60, function () {
                    return Setting::all(['key', 'value'])
                        ->pluck('value', 'key')
                        ->toArray();
                });

                Config::set('settings', $settings);
            }
        } catch (\Exception $e) {
            // DB bağlantısı kurulamadığında veya tablo olmadığında yoksay.
        }

        view()->composer('components.live-ticker', function ($view) {
            $api = app(\App\Services\API::class);
            $key = 'credits_list_payload_v3';
            $payload = \Illuminate\Support\Facades\Cache::get($key);

            if (!is_array($payload)) {
                $payload = $api->get('api/credits/list');
                if ($payload !== []) {
                    // ID'si 1 olanı çıkar
                    $payload['data'] = array_filter($payload['data'], function ($item) {
                        return $item['bank_id'] !== '9b998fb1-00a2-4481-9c40-03a5ccbf7c85';
                    });
                    \Illuminate\Support\Facades\Cache::put($key, $payload, 60);
                }
            }

            $data = is_array($payload) && isset($payload['data']) ? $payload['data'] : [];

            // Filter and sort for ticker
            $data = array_filter($data, function ($b) {
                return ($b['id'] ?? '') !== "5fcc7312-7754-4a1e-96fd-53e70f3b1514";
            });

            usort($data, function ($a, $b) {
                return (float) ($b['interest_rate'] ?? 0) <=> (float) ($a['interest_rate'] ?? 0);
            });

            $tickerRows = array_map(function ($b) {
                return [
                    'id' => (string) ($b['id'] ?? ""),
                    'name' => trim($b['banks']['name'] ?? "Bank"),
                    'rate' => (float) ($b['interest_rate'] ?? 0),
                ];
            }, $data);

            $view->with('tickerRows', array_values($tickerRows));
        });
    }
}
