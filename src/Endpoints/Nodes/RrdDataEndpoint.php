<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\RrdDataRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class RrdDataEndpoint
 *
 * This class handles operations related to reading node RRD statistics.
 */
class RrdDataEndpoint extends Endpoint
{
    /**
     * Read node RRD statistics.
     *
     * @param RrdDataRequest $request The request object containing the node name and optional parameters.
     * @return Result The result object containing the RRD data or error message.
     */
    public function get(RrdDataRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/rrddata', $request->node),
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $exception) {
            return new Result(
                success: false,
                message: $exception->getMessage(),
            );
        }

        return new Result(
            success: true,
            data: [
                'rrdData' => $data,
            ],
        );
    }
}
