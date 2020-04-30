<?php

namespace YWatchman\ProxmoxMGW\Requests;

use YWatchman\ProxmoxMGW\Client;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;

class Access
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getTicket()
    {
        try {
            return $this->client->makeRequest('/access/ticket', 'POST', [
                'username' => $this->client->getUsername(),
                'password' => $this->client->getPassword(),
                'realm' => $this->client->getRealm()
            ]);
        } catch (InvalidRequestException $e) {
            return null;
        }
    }
}
