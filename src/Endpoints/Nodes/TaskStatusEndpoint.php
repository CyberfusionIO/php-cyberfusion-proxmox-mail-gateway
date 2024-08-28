<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ReadTaskStatusRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\TaskStatus;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class TaskStatusEndpoint extends Endpoint
{
    /**
     * Read task status.
     *
     * @param ReadTaskStatusRequest $request
     * @return Result
     */
    public function read(ReadTaskStatusRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/tasks/%s/status', $request->node, $request->upid),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $taskStatus = new TaskStatus($data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['taskStatus' => $taskStatus]);
    }
}
