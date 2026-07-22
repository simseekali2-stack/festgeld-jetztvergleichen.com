<?php

namespace App\Services;

class API
{

    private $baseUrl = 'https://connect.connect-depot.com';

    private function buildUrl(string $endpoint, array $queries = []): string
    {
        return sprintf(
            '%s/%s%s',
            rtrim($this->baseUrl, '/'),
            ltrim($endpoint, '/'),
            !empty($queries) ? '?' . http_build_query($queries) : ''
        );
    }

    private function request(string $url, string $method, array $params = [], array $headers = []): array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $defaultHeaders = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Origin: ' . config('app.origin')
        ];

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        } elseif (in_array($method, ['PUT', 'DELETE', 'PATCH'])) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($defaultHeaders, $headers));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        $errmsg = curl_error($ch);
        $httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($response === false || $errno !== 0) {
            error_log("API curl #{$errno}: {$errmsg} | {$url}");

            return [];
        }

        if ($httpCode < 200 || $httpCode >= 300) {
            error_log("API HTTP {$httpCode} | {$url} | " . mb_substr((string) $response, 0, 300));

            return [];
        }

        $decoded = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('API JSON decode: ' . json_last_error_msg() . ' | ' . mb_substr((string) $response, 0, 200));

            return [];
        }

        return is_array($decoded) ? $decoded : [];
    }

    public function get(string $endpoint, array $params = [], array $headers = []): array
    {
        try {
            return $this->request($this->buildUrl($endpoint, $params), 'GET', [], $headers);
        } catch (\Exception $e) {
            error_log('API GET request failed: ' . $e->getMessage());
            return [];
        }
    }

    public function post(string $endpoint, array $data, array $headers = []): array
    {
        try {
            return $this->request($this->buildUrl($endpoint, []), 'POST', $data, $headers);
        } catch (\Exception $e) {
            error_log('API POST request failed: ' . $e->getMessage());
            return [];
        }
    }

    public function put(string $endpoint, array $data, array $headers = []): array
    {
        try {
            return $this->request($this->buildUrl($endpoint, []), 'PUT', $data, $headers);
        } catch (\Exception $e) {
            error_log('API PUT request failed: ' . $e->getMessage());
            return [];
        }
    }

    public function delete(string $endpoint, array $params = [], array $headers = []): array
    {
        try {
            return $this->request($this->buildUrl($endpoint, $params), 'DELETE', [], $headers);
        } catch (\Exception $e) {
            error_log('API DELETE request failed: ' . $e->getMessage());
            return [];
        }
    }

    public function patch(string $endpoint, array $data, array $headers = []): array
    {
        try {
            return $this->request($this->buildUrl($endpoint, []), 'PATCH', $data, $headers);
        } catch (\Exception $e) {
            error_log('API PATCH request failed: ' . $e->getMessage());
            return [];
        }
    }

}