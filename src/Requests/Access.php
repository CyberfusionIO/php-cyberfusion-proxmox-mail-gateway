<?php

namespace YWatchman\ProxmoxMGW\Requests;

use YWatchman\ProxmoxMGW\Client;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;

class Access
{
    protected $client;

    public $ticket;

    public $csrf;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getTicket(): void
    {
        try {
            $result = $this->client->makeRequest('/access/ticket', 'POST', [
                'username' => $this->client->getUsername(),
                'password' => $this->client->getPassword(),
                'realm' => $this->client->getRealm()
            ]);
        } catch (InvalidRequestException $e) {
            return;
        }

        $ticket = json_decode($result->getBody()->getContents(), true);

        $this->ticket = $ticket['data']['ticket'];
        $this->csrf = $ticket['data']['CSRFPreventionToken'];
    }
}
