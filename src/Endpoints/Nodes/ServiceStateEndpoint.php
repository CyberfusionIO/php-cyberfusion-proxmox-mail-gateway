<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceStateRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\ServiceState;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ServiceStateEndpoint extends Endpoint
{
    /**
     * Read service properties.
     *
     * @param ServiceStateRequest $request
     * @return Result
     */
    public function get(ServiceStateRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services/%s/state', $request->node, $request->service),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $serviceState = new ServiceState(
            // Add properties here based on the actual response
        );

        return new Result(
            success: true,
            data: [
                'serviceState' => $serviceState,
            ],
        );
    }
}
