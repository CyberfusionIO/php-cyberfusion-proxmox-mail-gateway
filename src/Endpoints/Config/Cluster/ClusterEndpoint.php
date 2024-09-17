<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Config\Cluster;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Config\Cluster\CreateClusterRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Cluster\JoinClusterRequest;
use Cyberfusion\ProxmoxMGW\Requests\Config\Cluster\UpdateFingerprintsRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class ClusterEndpoint extends Endpoint
{
    /**
     * Create initial cluster config with current node as master.
     *
     * @param CreateClusterRequest $request
     * @return Result
     */
    public function create(CreateClusterRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/cluster/create',
                method: 'POST',
                params: $request->toArray(),
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
                'result' => $data['data'],
            ],
        );
    }

    /**
     * Join local node to an existing cluster.
     *
     * @param JoinClusterRequest $request
     * @return Result
     */
    public function join(JoinClusterRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/cluster/join',
                method: 'POST',
                params: $request->toArray(),
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
                'result' => $data['data'],
            ],
        );
    }

    /**
     * Update API certificate fingerprints (by fetching it via ssh).
     *
     * @param UpdateFingerprintsRequest $request
     * @return Result
     */
    public function updateFingerprints(UpdateFingerprintsRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: '/config/cluster/update-fingerprints',
                method: 'POST',
                params: $request->toArray(),
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
                'result' => $data['data'],
            ],
        );
    }
}
