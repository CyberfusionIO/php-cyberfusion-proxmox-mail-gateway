<?php

namespace YWatchman\ProxmoxMGW\Requests;

use Exception;
use YWatchman\ProxmoxMGW\Client;
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

    public function getNetworks()
    {
        return $this->client->makeRequest('/config/mynetworks');
    }

    public function delNetwork($cidr)
    {
        $validator = new InetAddr($cidr);
        $validator->validateCidr();

        try {
            $this->client->makeRequest('/config/mynetworks/' . $cidr, 'DELETE');
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function addNetwork($cidr, $comment = 'Not set')
    {
        $validator = new InetAddr($cidr);
        $validator->validateCidr();

        try {
            $this->client->makeRequest('/config/mynetworks', 'POST', [
                'cidr' => $cidr,
                'comment' => $comment,
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
