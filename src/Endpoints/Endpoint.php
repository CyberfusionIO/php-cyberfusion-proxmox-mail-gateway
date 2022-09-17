<?php

namespace YWatchman\ProxmoxMGW\Endpoints;

use YWatchman\ProxmoxMGW\Client;

abstract class Endpoint
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
