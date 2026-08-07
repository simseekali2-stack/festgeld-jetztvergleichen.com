<?php

namespace App\Http\Controllers;

use App\Services\API;
use App\Services\FormSubmitService;
use App\Services\MarketDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class APIController extends Controller
{

    public function __construct(
        private API $api,
        private FormSubmitService $formSubmitService,
        private MarketDataService $marketDataService
    ) {
    }

    public function marketData()
    {
        return response()->json([
            'success' => true,
            'data' => $this->marketDataService->getQuotes()
        ]);
    }

    public function list(Request $request)
    {
        $key = 'credits_list_raw_v1';
        $payload = Cache::get($key);

        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if ($payload !== []) {
                Cache::put($key, $payload, 60);
            }
        }

        if (isset($payload['data']) && is_array($payload['data'])) {
            $payload['data'] = array_values(array_filter($payload['data'], function ($item) {
                $bankId = $item['bank_id'] ?? '';
                $bankName = strtolower($item['banks']['name'] ?? '');

                if ($bankId === '9b998fb1-00a2-4481-9c40-03a5ccbf7c85') {
                    return false;
                }

                if (empty($bankName) || 
                    str_contains($bankName, 'tier') || 
                    str_contains($bankName, 'festgeld-') || 
                    str_contains($bankName, 'tagesgeld-') || 
                    str_contains($bankName, 'mock')) {
                    return false;
                }

                return true;
            }));
        }

        return response()->json($payload);
    }

    public function submit(Request $request)
    {
        $data = $request->json()->all();
        $ip = $request->ip();

        $result = $this->formSubmitService->process($data, $ip);

        return response()->json($result['data'], $result['status']);
    }
}
