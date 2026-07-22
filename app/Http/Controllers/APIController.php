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
        // v2: boş [] bir kez cache’lenmiş olabilirdi (geçici hata); v3 ile anahtar değişti.
        // Boş dizi dönen yanıtları cache’leme — aksi halde 60 sn boyunca API’ye hiç gidilmez.
        $key = 'credits_list_payload_v3';
        $payload = Cache::get($key);

        if (!is_array($payload)) {
            $payload = $this->api->get('api/credits/list');
            if ($payload !== []) {

                // ID'si 1 olanı çıkar
                $payload['data'] = array_filter($payload['data'], function ($item) {
                    return $item['bank_id'] !== '9b998fb1-00a2-4481-9c40-03a5ccbf7c85';
                });

                Cache::put($key, $payload, 60);
            }
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
