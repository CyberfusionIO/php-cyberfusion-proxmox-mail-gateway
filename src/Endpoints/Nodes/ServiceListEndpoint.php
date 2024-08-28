<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceListRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Service;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ServiceListEndpoint extends Endpoint
{
    /**
     * Get the service list for a node.
     *
     * @param ServiceListRequest $request
     * @return Result
     */
    public function get(ServiceListRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $services = collect();
        foreach (Arr::get($data, 'data', []) as $service) {
            $services->push(new Service(
                // Add properties here based on the actual response
            ));
        }

        return new Result(
            success: true,
            data: [
                'services' => $services,
            ],
        );
    }
}
