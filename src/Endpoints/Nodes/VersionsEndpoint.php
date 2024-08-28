<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\VersionsRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Version;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class VersionsEndpoint extends Endpoint
{
    /**
     * Get package information for important Proxmox packages.
     *
     * @param VersionsRequest $request
     * @return Result
     */
    public function get(VersionsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/versions', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $versions = collect();
        foreach ($data as $version) {
            $versions->push(new Version($version));
        }

        return new Result(
            success: true,
            data: [
                'versions' => $versions,
            ],
        );
    }
}
