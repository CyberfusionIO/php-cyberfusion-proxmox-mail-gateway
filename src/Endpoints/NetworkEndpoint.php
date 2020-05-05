<?php

namespace YWatchman\ProxmoxMGW\Endpoints;

use YWatchman\ProxmoxMGW\Exceptions\InetAddrValidationException;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;
use YWatchman\ProxmoxMGW\Exceptions\NetworkException;
use YWatchman\ProxmoxMGW\Result\Network;
use YWatchman\ProxmoxMGW\Result\Result;
use YWatchman\ProxmoxMGW\Support\InetAddr;

class NetworkEndpoint extends Endpoint
{

    /**
     * Get networks that can access Proxmox.
     *
     * @return Result
     * @throws InvalidRequestException
     */
    public function getNetworks()
    {
        $request = $this->client->makeRequest('/config/mynetworks');

        if ($request->getStatusCode() !== 200) {
//            throw new ProxmoxExcep
        }

        $data = json_decode($request->getBody()->getContents());
        $networks = [];

        foreach ($data->data as $network) {
            $networks[] = new Network(
                $network->prefix_size,
                $network->comment,
                $network->network_address,
                $network->cidr
            );
        }

        return new Result(true, 'Retrieved networks.', $networks);
    }

    /**
     * Delete Proxmox Relay network.
     *
     * @param $cidr
     * @return Result
     * @throws NetworkException
     * @throws InetAddrValidationException
     * @throws InvalidRequestException
     */
    public function delete($cidr)
    {
        $validator = new InetAddr($cidr);
        $validator->validateCidr();

        $request = $this->client->makeRequest(
            sprintf('/config/mynetworks/%s', $cidr),
            'DELETE'
        );

        if ($request->getStatusCode() === 500) {
            throw new NetworkException(
                sprintf('Network %s does not exist.', $cidr),
                NetworkException::NETWORK_DOES_NOT_EXIST
            );
        }

        return new Result(true, 'Network is deleted.');
    }

    public function create($cidr, $comment = 'Not set')
    {
        $validator = new InetAddr($cidr);
        $validator->validateCidr();

        $request = $this->client->makeRequest('/config/mynetworks', 'POST', [
            'cidr' => $cidr,
            'comment' => $comment,
        ]);

        if ($request->getStatusCode() === 500) {
            throw new NetworkException(
                sprintf('Network %s already exists.', $cidr),
                NetworkException::NETWORK_ALREADY_EXISTS
            );
        }

        return new Result(true, 'Network is created.');
    }
}
