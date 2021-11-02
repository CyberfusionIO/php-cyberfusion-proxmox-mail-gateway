<?php

namespace YWatchman\ProxmoxMGW\Endpoints;

use Exception;
use Illuminate\Support\Str;
use YWatchman\ProxmoxMGW\Exceptions\InvalidRequestException;
use YWatchman\ProxmoxMGW\Result\Network;
use YWatchman\ProxmoxMGW\Result\Result;
use YWatchman\ProxmoxMGW\Support\InetAddr;

class NetworkEndpoint extends Endpoint
{
    /**
     * Get networks that can access Proxmox.
     *
     * @return Result
     */
    public function getNetworks(): Result
    {
        try {
            $request = $this
                ->client
                ->makeRequest('/config/mynetworks');
        } catch (InvalidRequestException $exception) {
            return new Result(false, $exception->getMessage());
        }

        if ($request->getStatusCode() !== 200) {
            return new Result(false, $request->getReasonPhrase(), [
                'data' => json_decode($request->getBody()->getContents())
            ]);
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
     * The proxmox api requires a full cidr. So when a single ip is provided, add the /32 part.
     *
     * @param string $cidr
     * @return string
     */
    private function prepareCidr(string $cidr): string
    {
        if (Str::contains($cidr, '/')) {
            return $cidr;
        }

        $range = 32;
        if (Str::contains($cidr, ':')) {
            $range = 128;
        }

        return sprintf('%s/%d', $cidr, $range);
    }

    /**
     * Delete Proxmox Relay network.
     *
     * @param string $cidr
     * @return Result
     */
    public function delete(string $cidr): Result
    {
        $cidr = $this->prepareCidr($cidr);

        try {
            $validator = new InetAddr($cidr);
            $validator->validateCidr();
        } catch (Exception $exception) {
            return new Result(false, $exception->getMessage());
        }

        try {
            $request = $this
                ->client
                ->makeRequest(
                    sprintf('/config/mynetworks/%s', $cidr),
                    'DELETE'
                );
        } catch (InvalidRequestException $exception) {
            return new Result(false, $exception->getMessage());
        }

        return new Result(
            $request->getStatusCode() === 200,
            $request->getReasonPhrase(),
            [
                'data' => json_decode($request->getBody()->getContents())
            ]
        );
    }

    /**
     * Create the Proxmox Relay network.
     *
     * @param string $cidr
     * @param string $comment
     * @return Result
     */
    public function create(string $cidr, string $comment): Result
    {
        $cidr = $this->prepareCidr($cidr);

        try {
            $validator = new InetAddr($cidr);
            $validator->validateCidr();
        } catch (Exception $exception) {
            return new Result(false, $exception->getMessage());
        }

        try {
            $request = $this
                ->client
                ->makeRequest('/config/mynetworks', 'POST', [
                    'cidr' => $cidr,
                    'comment' => $comment,
                ]);
        } catch (InvalidRequestException $exception) {
            return new Result(false, $exception->getMessage());
        }

        return new Result(
            $request->getStatusCode() === 200,
            $request->getReasonPhrase(),
            [
                'data' => json_decode($request->getBody()->getContents())
            ]
        );
    }
}
