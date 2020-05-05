<?php

namespace YWatchman\ProxmoxMGW\Requests;

use YWatchman\ProxmoxMGW\Client;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;

class Access
{
    /** @var Client  */
    protected $client;

    /** @var string */
    public $ticket;

    /** @var string */
    public $csrf;

    /**
     * Access constructor.
     *
     * @param Client $client
     */
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
