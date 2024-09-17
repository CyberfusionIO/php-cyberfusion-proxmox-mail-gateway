<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Models\Nodes\ClamavDatabaseStatus;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ClamavDatabaseRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Illuminate\Support\Arr;
use Throwable;

class ClamavEndpoint extends Endpoint
{
    /**
     * Get ClamAV virus database status.
     *
     * @param ClamavDatabaseRequest $request
     * @return Result
     */
    public function getDatabaseStatus(ClamavDatabaseRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/nodes/{$request->node}/clamav/database",
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $statuses = collect();
        foreach ($data as $item) {
            $statuses->push(new ClamavDatabaseStatus(
                build_time: Arr::get($item, 'build_time'),
                nsigs: Arr::get($item, 'nsigs'),
                type: Arr::get($item, 'type'),
                version: Arr::get($item, 'version'),
            ));
        }

        return new Result(
            success: true,
            data: [
                'statuses' => $statuses,
            ],
        );
    }

    /**
     * Update ClamAV virus databases.
     *
     * @param ClamavDatabaseRequest $request
     * @return Result
     */
    public function updateDatabase(ClamavDatabaseRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: "/nodes/{$request->node}/clamav/database",
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
            data: [
                'result' => $data,
            ],
        );
    }
}
