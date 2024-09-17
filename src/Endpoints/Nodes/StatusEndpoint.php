<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\NodeStatus;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\StatusGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\StatusUpdateRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class StatusEndpoint extends Endpoint
{
    /**
     * Read server status.
     *
     * @param StatusGetRequest $request
     * @return Result
     */
    public function get(StatusGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/status', $request->node),
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
                'nodeStatus' => new NodeStatus(
                    bootInfo: Arr::get($data, 'boot-info'),
                    currentKernel: Arr::get($data, 'current-kernel'),
                    insync: Arr::get($data, 'insync'),
                    time: Arr::get($data, 'time'),
                    uptime: Arr::get($data, 'uptime'),
                ),
            ],
        );
    }

    /**
     * Reboot or shutdown a node.
     *
     * @param StatusUpdateRequest $request
     * @return Result
     */
    public function update(StatusUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/status', $request->node),
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
