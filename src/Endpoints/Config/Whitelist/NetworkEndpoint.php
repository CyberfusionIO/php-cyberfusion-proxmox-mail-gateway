<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Whitelist;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Config\Whitelist\Network;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\NetworkCreateRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\NetworkGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Whitelist\NetworkUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class NetworkEndpoint extends Endpoint
{
    /**
     * Add 'IP Network' object.
     *
     * @param NetworkCreateRequest $request
     * @return Result
     */
    public function create(NetworkCreateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/whitelist/network',
                method: 'POST',
                params: [
                    'cidr' => $request->cidr,
                ],
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'id' => $data,
            ],
        );
    }

    /**
     * Read 'IP Network' object settings.
     *
     * @param NetworkGetRequest $request
     * @return Result
     */
    public function get(NetworkGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/network/%d', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'network' => new Network(
                    id: Arr::get($data, 'id'),
                ),
            ],
        );
    }

    /**
     * Update 'IP Network' object.
     *
     * @param NetworkUpdateRequest $request
     * @return Result
     */
    public function update(NetworkUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/whitelist/network/%d', $request->id),
                method: 'PUT',
                params: [
                    'cidr' => $request->cidr,
                ],
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
