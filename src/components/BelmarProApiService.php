<?php

namespace App\components;

class BelmarProApiService
{
    private const ENDPOINT_GET_STATUSES = 'getstatuses';
    private const ENDPOINT_ADD_LEAD = 'addlead';
    private BelmarProApiClient $client;

    public function __construct()
    {
        $this->client = new BelmarProApiClient();
    }

    public function addLead(array $params): array
    {
        return $this->client->post(self::ENDPOINT_ADD_LEAD, $params);
    }
    public function getStatuses(array $params): array
    {
        return $this->client->post(self::ENDPOINT_GET_STATUSES, $params);
    }
}