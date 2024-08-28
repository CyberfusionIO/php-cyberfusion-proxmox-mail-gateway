<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\TrustedNetwork;
use Cyberfusion\ProxmoxMGW\Requests\MyNetworksListRequest;
use Cyberfusion\ProxmoxMGW\Requests\MyNetworksCreateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class MyNetworksEndpoint extends Endpoint
{
    /**
     * List of trusted networks from where SMTP clients are allowed to relay mail through Proxmox Mail Gateway.
     *
     * @param MyNetworksListRequest $request
     * @return Result
     */
    public function list(MyNetworksListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/mynetworks',
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $trustedNetworks = collect();
        foreach (Arr::get($data, 'data', []) as $item) {
            $trustedNetworks->push(new TrustedNetwork(
                cidr: Arr::get($item, 'cidr'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'trustedNetworks' => $trustedNetworks,
            ],
        );
    }

    /**
     * Add a trusted network.
     *
     * @param MyNetworksCreateRequest $request
     * @return Result
     */
    public function create(MyNetworksCreateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/mynetworks',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(success: true);
    }
}
