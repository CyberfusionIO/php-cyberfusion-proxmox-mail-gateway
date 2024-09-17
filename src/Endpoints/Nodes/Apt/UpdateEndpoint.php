<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Apt;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt\ListUpdatesRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt\UpdateDatabaseRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Apt\UpdateInfo;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class UpdateEndpoint extends Endpoint
{
    /**
     * List available updates.
     *
     * @param ListUpdatesRequest $request
     * @return Result
     */
    public function listUpdates(ListUpdatesRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/update', $request->node),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        $updates = collect();
        foreach ($data as $update) {
            $updates->push(new UpdateInfo($update));
        }

        return new Result(
            success: true,
            data: [
                'updates' => $updates,
            ],
        );
    }

    /**
     * Resynchronize the package index files from their sources (apt-get update).
     *
     * @param UpdateDatabaseRequest $request
     * @return Result
     */
    public function updateDatabase(UpdateDatabaseRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/update', $request->node),
                method: 'POST',
                params: $request->toArray(),
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
