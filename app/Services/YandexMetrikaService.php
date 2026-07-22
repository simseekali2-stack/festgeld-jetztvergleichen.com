<?php

namespace App\Services;

class YandexMetrikaService
{
    private string $baseUrl = 'https://api-metrika.yandex.net/stat/v1/data';
    private string $token;
    private string $counterId;

    public function __construct()
    {
        $this->token = (string) config('services.yandex_metrika.token', '');
        $this->counterId = (string) config('services.yandex_metrika.counter_id', '');
    }

    public function isConfigured(): bool
    {
        return $this->token !== '' && $this->counterId !== '';
    }

    private function get(array $params): array
    {
        $params['ids'] = $this->counterId;
        $url = $this->baseUrl . '?' . http_build_query($params);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: OAuth ' . $this->token,
            'Accept: application/json',
        ]);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $errno !== 0 || $httpCode < 200 || $httpCode >= 300) {
            return [];
        }

        $data = json_decode($response, true);
        return is_array($data) ? $data : [];
    }

    /**
     * Genel özet: ziyaret sayısı, kullanıcı, hemen çıkma, sayfa derinliği
     */
    public function getSummary(string $date1, string $date2): array
    {
        $data = $this->get([
            'metrics' => 'ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds',
            'date1' => $date1,
            'date2' => $date2,
        ]);

        if (empty($data['totals'])) {
            return [];
        }

        return [
            'visits'               => (int) ($data['totals'][0] ?? 0),
            'users'                => (int) ($data['totals'][1] ?? 0),
            'bounce_rate'          => round((float) ($data['totals'][2] ?? 0), 1),
            'page_depth'           => round((float) ($data['totals'][3] ?? 0), 2),
            'avg_duration_seconds' => (int) ($data['totals'][4] ?? 0),
        ];
    }

    /**
     * En çok ziyaret edilen sayfalar
     */
    public function getTopPages(string $date1, string $date2, int $limit = 10): array
    {
        $data = $this->get([
            'dimensions' => 'ym:pv:URLPathFull',
            'metrics'    => 'ym:pv:pageviews,ym:pv:users',
            'date1'      => $date1,
            'date2'      => $date2,
            'sort'       => '-ym:pv:pageviews',
            'limit'      => $limit,
        ]);

        if (empty($data['data'])) {
            return [];
        }

        return array_map(function (array $row) {
            return [
                'url'       => $row['dimensions'][0]['name'] ?? '/',
                'pageviews' => (int) ($row['metrics'][0] ?? 0),
                'users'     => (int) ($row['metrics'][1] ?? 0),
            ];
        }, $data['data']);
    }

    /**
     * Trafik kaynakları
     */
    public function getTrafficSources(string $date1, string $date2): array
    {
        $data = $this->get([
            'dimensions' => 'ym:s:trafficSource',
            'metrics'    => 'ym:s:visits',
            'date1'      => $date1,
            'date2'      => $date2,
            'sort'       => '-ym:s:visits',
            'limit'      => 10,
        ]);

        if (empty($data['data'])) {
            return [];
        }

        $sourceLabels = [
            'direct'     => 'Direkt',
            'organic'    => 'Organik Arama',
            'referral'   => 'Referans',
            'social'     => 'Sosyal Medya',
            'ad'         => 'Reklam',
            'email'      => 'E-Posta',
            'undefined'  => 'Diğer',
        ];

        return array_map(function (array $row) use ($sourceLabels) {
            $key = $row['dimensions'][0]['id'] ?? 'undefined';
            return [
                'source' => $sourceLabels[$key] ?? $row['dimensions'][0]['name'] ?? $key,
                'visits' => (int) ($row['metrics'][0] ?? 0),
            ];
        }, $data['data']);
    }

    /**
     * En yüksek hemen çıkma oranına sahip sayfalar (kullanıcının takıldığı yerler)
     */
    public function getHighBouncePages(string $date1, string $date2, int $limit = 10): array
    {
        $data = $this->get([
            'dimensions' => 'ym:s:startURLPathFull',
            'metrics'    => 'ym:s:visits,ym:s:bounceRate',
            'date1'      => $date1,
            'date2'      => $date2,
            'sort'       => '-ym:s:bounceRate',
            'filters'    => 'ym:s:visits >= 5',
            'limit'      => $limit,
        ]);

        if (empty($data['data'])) {
            return [];
        }

        return array_map(function (array $row) {
            return [
                'url'         => $row['dimensions'][0]['name'] ?? '/',
                'visits'      => (int) ($row['metrics'][0] ?? 0),
                'bounce_rate' => round((float) ($row['metrics'][1] ?? 0), 1),
            ];
        }, $data['data']);
    }

    /**
     * Günlük ziyaretçi grafiği için veri (son N gün)
     */
    public function getDailyVisits(string $date1, string $date2): array
    {
        $data = $this->get([
            'dimensions' => 'ym:s:date',
            'metrics'    => 'ym:s:visits,ym:s:users',
            'date1'      => $date1,
            'date2'      => $date2,
            'sort'       => 'ym:s:date',
        ]);

        if (empty($data['data'])) {
            return [];
        }

        return array_map(function (array $row) {
            return [
                'date'   => $row['dimensions'][0]['name'] ?? '',
                'visits' => (int) ($row['metrics'][0] ?? 0),
                'users'  => (int) ($row['metrics'][1] ?? 0),
            ];
        }, $data['data']);
    }

    /**
     * Cihaz türüne göre dağılım
     */
    public function getDeviceStats(string $date1, string $date2): array
    {
        $data = $this->get([
            'dimensions' => 'ym:s:deviceCategory',
            'metrics'    => 'ym:s:visits',
            'date1'      => $date1,
            'date2'      => $date2,
            'sort'       => '-ym:s:visits',
        ]);

        if (empty($data['data'])) {
            return [];
        }

        $deviceLabels = [
            'desktop' => 'Masaüstü',
            'mobile'  => 'Mobil',
            'tablet'  => 'Tablet',
        ];

        return array_map(function (array $row) use ($deviceLabels) {
            $key = $row['dimensions'][0]['id'] ?? '';
            return [
                'device' => $deviceLabels[$key] ?? $row['dimensions'][0]['name'] ?? $key,
                'visits' => (int) ($row['metrics'][0] ?? 0),
            ];
        }, $data['data']);
    }
}
