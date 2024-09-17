<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\StopTaskRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\GetTaskRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Task;
use Cyberfusion\ProxmoxMGW\Support\Result;
use Throwable;

class TaskEndpoint extends Endpoint
{
    /**
     * Stop a task.
     *
     * @param StopTaskRequest $request
     * @return Result
     */
    public function stop(StopTaskRequest $request): Result
    {
        try {
            $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/tasks/%s', $request->node, $request->upid),
                method: 'DELETE',
            );
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true);
    }

    /**
     * Get task information.
     *
     * @param GetTaskRequest $request
     * @return Result
     */
    public function get(GetTaskRequest $request): Result
    {
        try {
            $response = $this->client->makeRequest(
                endpoint: sprintf('/nodes/%s/tasks/%s', $request->node, $request->upid),
                method: 'GET',
            );

            $data = json_decode($response->getBody()->getContents(), true);
            $task = new Task($data);
        } catch (Throwable $exception) {
            return new Result(success: false, message: $exception->getMessage());
        }

        return new Result(success: true, data: ['task' => $task]);
    }
}
