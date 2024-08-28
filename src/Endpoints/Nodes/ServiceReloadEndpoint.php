<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceReloadRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class ServiceReloadEndpoint extends Endpoint
{
    /**
     * Reload service.
     *
     * @param ServiceReloadRequest $request
     * @return Result
     */
    public function reload(ServiceReloadRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services/%s/reload', $request->node, $request->service),
                method: 'POST',
            );

            $data = $response->getBody()->getContents();
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: ['result' => $data],
        );
    }
}
