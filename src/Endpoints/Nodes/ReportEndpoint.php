<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ReportRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

/**
 * Class ReportEndpoint
 *
 * This class handles operations related to gathering system information about a node.
 */
class ReportEndpoint extends Endpoint
{
    /**
     * Gather various system information about a node.
     *
     * @param ReportRequest $request The request object containing the node name.
     * @return Result The result object containing the system information or error message.
     */
    public function get(ReportRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/report', $request->node),
                method: 'GET',
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
                'report' => $data,
            ],
        );
    }
}
