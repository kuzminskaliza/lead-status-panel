<?php

namespace App\components;

class BelmarProApiService
{
    private BelmarProApiClient $client;

    public function __construct(string $baseUrl, string $token)
    {
        $this->client = new BelmarProApiClient($baseUrl, $token);
    }

    public function addLead(array $formData): array
    {
        return $this->client->post('addlead', $formData);
    }
}