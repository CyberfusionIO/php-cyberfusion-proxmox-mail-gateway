<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes\Pbs;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs\ForgetSnapshotRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\Pbs\RestoreSnapshotRequest;
use Cyberfusion\ProxmoxMGW\Support\Result;

class SnapshotEndpoint extends Endpoint
{
    /**
     * Forget a snapshot
     *
     * @param ForgetSnapshotRequest $request
     * @return Result
     */
    public function forgetSnapshot(ForgetSnapshotRequest $request): Result
    {
        // Implementation
    }

    /**
     * Restore the system configuration.
     *
     * @param RestoreSnapshotRequest $request
     * @return Result
     */
    public function restoreSnapshot(RestoreSnapshotRequest $request): Result
    {
        // Implementation
    }
}
