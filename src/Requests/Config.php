<?php

namespace YWatchman\ProxmoxMGW\Requests;

use Exception;
use YWatchman\ProxmoxMGW\Client;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;
use YWatchman\ProxmoxMGW\Support\InetAddr;

class Config
{
    /** @var Client  */
    protected $client;

    /** @var string  */
    protected $cidr;

    public function __construct(Client $client, string $cidr)
    {
        $this->client = $client;
        $this->cidr = $cidr;
    }

    /**
     * Get networks that can access Proxmox.
     *
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|null
     * @throws \YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException
     */
    public function getNetworks()
    {
        return $this->client->makeRequest('/config/mynetworks');
    }

    public function delNetwork($cidr)
    {
        $validator = new InetAddr($cidr);
        $validator->validateCidr();

        $request = $this->client->makeRequest(
            sprintf('/config/mynetworks/%s', $cidr),
            'DELETE'
        );

        return $request;
    }

    public function addNetwork($cidr, $comment = 'Not set')
    {
        $validator = new InetAddr($cidr);
        $validator->validateCidr();

        $request = $this->client->makeRequest('/config/mynetworks', 'POST', [
            'cidr' => $cidr,
            'comment' => $comment,
        ]);

        return $request;
    }
}
