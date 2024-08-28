<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\JournalRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class JournalEndpoint extends Endpoint
{
    /**
     * Read Journal
     *
     * @param JournalRequest $request
     * @return Result
     */
    public function get(JournalRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/journal', $request->node),
                method: 'GET',
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
                'journal' => $data,
            ],
        );
    }
}
