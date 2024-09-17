<?php

namespace Cyberfusion\ProxmoxPVE\Endpoints\Nodes;

use Cyberfusion\ProxmoxPVE\Endpoints\Endpoint;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\GetNodeTasksRequest;
use Cyberfusion\ProxmoxPVE\Models\Nodes\Task;
use Cyberfusion\ProxmoxPVE\Support\Result;

class TasksEndpoint extends Endpoint
{
    /**
     * Read task list for one node (finished tasks).
     *
     * @param GetNodeTasksRequest $request
     * @return Result
     */
    public function get(GetNodeTasksRequest $request): Result
    {
        // Implementation
    }
}
