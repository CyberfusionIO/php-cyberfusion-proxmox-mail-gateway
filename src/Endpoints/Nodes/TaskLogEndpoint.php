<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\ReadTaskLogRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\TaskLog;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class TaskLogEndpoint extends Endpoint
{
    /**
     * Read task log.
     *
     * @param ReadTaskLogRequest $request
     * @return Result
     */
    public function read(ReadTaskLogRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/tasks/%s/log', $request->node, $request->upid),
                method: 'GET',
                params: $request->toArray(),
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $taskLogs = array_map(fn($item) => new TaskLog($item), $data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['taskLogs' => $taskLogs]);
    }
}
