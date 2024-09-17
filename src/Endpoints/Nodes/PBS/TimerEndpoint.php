<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\PBS;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS\CreateTimerRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS\DeleteTimerRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\PBS\ListTimerRequest;
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
