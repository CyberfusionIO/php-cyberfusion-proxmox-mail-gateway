<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\PbsRemoteDeleteRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\PbsRemoteGetRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\PbsRemoteUpdateRequest;
use Cyberfusion\ProxmoxMGW\Models\Config\PbsRemoteConfig;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class PbsRemoteEndpoint extends Endpoint
{
    /**
     * Delete an PBS remote.
     *
     * @param PbsRemoteDeleteRequest $request
     * @return Result
     */
    public function delete(PbsRemoteDeleteRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/pbs/%s', $request->remote),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Get Proxmox Backup Server remote configuration.
     *
     * @param PbsRemoteGetRequest $request
     * @return Result
     */
    public function get(PbsRemoteGetRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/config/pbs/%s', $request->remote),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $config = new PbsRemoteConfig($data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['config' => $config]);
    }

    /**
     * Update PBS remote settings.
     *
     * @param PbsRemoteUpdateRequest $request
     * @return Result
     */
    public function update(PbsRemoteUpdateRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/config/pbs/%s', $request->remote),
                method: 'PUT',
                params: $request->toArray(),
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }
}
