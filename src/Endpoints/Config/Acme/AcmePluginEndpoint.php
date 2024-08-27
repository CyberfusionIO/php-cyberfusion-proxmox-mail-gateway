<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Acme;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmePluginDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmePluginGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Acme\AcmePluginUpdateRequest;
use Cyberfusion\ProxmoxMGW\Models\Config\Acme\AcmePluginConfig;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class AcmePluginEndpoint extends Endpoint
{
    /**
     * Delete ACME plugin configuration.
     *
     * @param AcmePluginDeleteRequest $request
     * @return Result
     */
    public function delete(AcmePluginDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/acme/plugins/%s', $request->id),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Get ACME plugin configuration.
     *
     * @param AcmePluginGetRequest $request
     * @return Result
     */
    public function get(AcmePluginGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/acme/plugins/%s', $request->id),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $config = new AcmePluginConfig($data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['config' => $config]);
    }

    /**
     * Update ACME plugin configuration.
     *
     * @param AcmePluginUpdateRequest $request
     * @return Result
     */
    public function update(AcmePluginUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/acme/plugins/%s', $request->id),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
