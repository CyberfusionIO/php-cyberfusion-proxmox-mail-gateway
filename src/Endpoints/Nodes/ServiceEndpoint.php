<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceStartRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceStopRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ServiceRestartRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class ServiceEndpoint extends Endpoint
{
    /**
     * Start a service.
     *
     * @param ServiceStartRequest $request
     * @return Result
     */
    public function start(ServiceStartRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services/%s/start', $request->node, $request->service),
                method: 'POST',
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
                'result' => $data,
            ],
        );
    }

    /**
     * Stop a service.
     *
     * @param ServiceStopRequest $request
     * @return Result
     */
    public function stop(ServiceStopRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services/%s/stop', $request->node, $request->service),
                method: 'POST',
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
                'result' => $data,
            ],
        );
    }

    /**
     * Restart a service.
     *
     * @param ServiceRestartRequest $request
     * @return Result
     */
    public function restart(ServiceRestartRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/services/%s/restart', $request->node, $request->service),
                method: 'POST',
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
                'result' => $data,
            ],
        );
    }
}
