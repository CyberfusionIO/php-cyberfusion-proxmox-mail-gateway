<?php

namespace YWatchman\ProxmoxMGW\Requests;

use Throwable;
use YWatchman\ProxmoxMGW\Client;

class Access
{
    protected Client $client;

    public ?string $ticket = null;

    public ?string $csrf = null;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Setup authentication data.
     */
    public function getTicket(): void
    {
        try {
            $result = $this->client->makeRequest('/access/ticket', 'POST', [
                'username' => $this->client->getUsername(),
                'password' => $this->client->getPassword(),
                'realm' => $this->client->getRealm(),
            ]);
        } catch (Throwable) {
            return;
        }

        $ticket = json_decode($result->getBody()->getContents(), true);

        $this->ticket = $ticket['data']['ticket'];
        $this->csrf = $ticket['data']['CSRFPreventionToken'];
    }
}
