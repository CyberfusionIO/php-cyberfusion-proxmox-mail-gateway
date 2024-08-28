<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\MyNetworkData;
use Cyberfusion\ProxmoxMGW\Requests\Config\MyNetworkDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\MyNetworkGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\MyNetworkUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class MyNetworksEndpoint extends Endpoint
{
    /**
     * Delete a trusted network.
     *
     * @param MyNetworkDeleteRequest $request
     * @return Result
     */
    public function delete(MyNetworkDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/mynetworks/%s', $request->cidr),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Read trusted network data (comment).
     *
     * @param MyNetworkGetRequest $request
     * @return Result
     */
    public function get(MyNetworkGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/mynetworks/%s', $request->cidr),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(
            success: true,
            data: [
                'myNetworkData' => new MyNetworkData(
                    cidr: Arr::get($data, 'cidr'),
                    comment: Arr::get($data, 'comment'),
                ),
            ],
        );
    }

    /**
     * Update trusted data (comment).
     *
     * @param MyNetworkUpdateRequest $request
     * @return Result
     */
    public function update(MyNetworkUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/mynetworks/%s', $request->cidr),
                method: 'PUT',
                params: [
                    'comment' => $request->comment,
                ],
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
