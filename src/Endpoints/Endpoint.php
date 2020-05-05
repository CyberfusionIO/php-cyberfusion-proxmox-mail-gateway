<?php

namespace YWatchman\ProxmoxMGW\Endpoints;

use YWatchman\ProxmoxMGW\Client;

abstract class Endpoint
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * Identity constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
