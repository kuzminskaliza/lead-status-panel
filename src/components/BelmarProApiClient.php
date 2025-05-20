<?php

namespace App\components;

use App\config\Config;
use Exception;

class BelmarProApiClient
{
    private ?string $baseUrl;
    private ?string $token;

    public function __construct()
    {
        $this->baseUrl = Config::get('components')['belmarProApiClient']['baseUrl'] ?? null;
        $this->token = Config::get('components')['belmarProApiClient']['token'] ?? null;;
    }
    public  function headers(): array
    {
        return [
            'Content-Type: application/json',
            'token: ' . $this->token,
        ];
    }

    public function get(string $url = '', array $params = []): array
    {
        $query = http_build_query($params);
        $fullUrl = $this->baseUrl . $url . '?' . $query;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $fullUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->headers()
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * @throws Exception
     */
    public function post(string $url, array $data): array
    {
        $ch = curl_init($this->baseUrl . $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers());
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $curlError = curl_error($ch);
        $hasCurlError = curl_errno($ch);
        curl_close($ch);

        $this->log('post', [
            'url' => $this->baseUrl . $url,
            'data' => $data,
            'response' => $response,
            'http_code' => $httpCode,
            'curl_error' => $curlError,
        ]);

        if ($httpCode !== 200) {
            throw new Exception('Error status code ' . $httpCode);
        }

        if ($hasCurlError) {
            throw new Exception('Curl error ' . $curlError);
        }

        $decoded = json_decode($response, true);
        if (
            empty($decoded)
            || !array_key_exists('status', $decoded)
            || $decoded['status'] !== true

        ) {
            throw new Exception('Not valid response ' . $response);
        }

        return $decoded;
    }
    public function put(string $url, array $data): array
    {
        return [];
    }

    public function delete(string $url, array $data): array
    {
        return [];
    }
    private function log(string $method, array $context = []): void
    {
        $logFile = __DIR__ . '/../runtime/logs/api-client.log';

        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'method' => strtoupper($method),
            'context' => $context,
        ];

        file_put_contents($logFile, json_encode($logEntry, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);
    }

}
