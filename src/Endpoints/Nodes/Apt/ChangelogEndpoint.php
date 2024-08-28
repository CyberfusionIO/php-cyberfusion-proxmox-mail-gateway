<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Apt;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt\ChangelogRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class ChangelogEndpoint extends Endpoint
{
    /**
     * Get package changelogs.
     *
     * @param ChangelogRequest $request
     * @return Result
     */
    public function getChangelog(ChangelogRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/apt/changelog', $request->node),
                method: 'GET',
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
                'changelog' => $data,
            ],
        );
    }
}
