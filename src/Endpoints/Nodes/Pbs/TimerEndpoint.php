<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Pbs;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs\DeleteTimerRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs\ListTimerRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs\CreateTimerRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\Pbs\Timer;
use Cyberfusion\ProxmoxMGW\Support\Result;

class TimerEndpoint extends Endpoint
{
    /**
     * Delete backup schedule
     *
     * @param DeleteTimerRequest $request
     * @return Result
     */
    public function deleteTimer(DeleteTimerRequest $request): Result
    {
        // Implementation
    }

    /**
     * Get timer specification
     *
     * @param ListTimerRequest $request
     * @return Result
     */
    public function listTimer(ListTimerRequest $request): Result
    {
        // Implementation
    }

    /**
     * Create backup schedule
     *
     * @param CreateTimerRequest $request
     * @return Result
     */
    public function createTimer(CreateTimerRequest $request): Result
    {
        // Implementation
    }
}
