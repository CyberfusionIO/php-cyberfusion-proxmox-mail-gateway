<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\AcmePluginsIndexRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\AcmePluginsAddRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class AcmePluginsEndpoint extends Endpoint
{
    /**
     * ACME plugin index.
     *
     * @param AcmePluginsIndexRequest $request
     * @return Result
     */
    public function index(AcmePluginsIndexRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/acme/plugins',
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: $data);
    }

    /**
     * Add ACME plugin configuration.
     *
     * @param AcmePluginsAddRequest $request
     * @return Result
     */
    public function add(AcmePluginsAddRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: '/config/acme/plugins',
                method: 'POST',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
