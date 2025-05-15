<?php

namespace App\components;

class BelmarProApiClient
{
    private string $baseUrl;
    private string $token;

    public function __construct(string $baseUrl, string $token)
    {
        $this->baseUrl = trim($baseUrl, '/');
        $this->token = $token;
    }

    public function get(string $url = '', array $params = []): array
    {
        $query = http_build_query($params);
        $fullUrl = $this->baseUrl . $url . '?' . $query;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $fullUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'token: ' . $this->token,
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    public function post(string $endpoint, array $data): array
    {
        $url = trim($this->baseUrl, '/') . '/' . trim($endpoint, '/');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'token: ' . $this->token,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $curlError = curl_error($ch);
        $hasCurlError = curl_errno($ch);
        curl_close($ch);

        if ($hasCurlError) {
            return ['error' => 'cURL error: ' . $curlError];
        }

        $decoded = json_decode($response, true);

        if (!is_array($decoded)) {
            return [
                'error' => 'Invalid response from API',
                'http_code' => $httpCode,
                'raw' => $response,
            ];
        }
        return $decoded;
    }

}
