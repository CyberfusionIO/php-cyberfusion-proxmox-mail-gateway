<?php

namespace Cyberfusion\ProxmoxMGW\Endpoints\Nodes;

use Cyberfusion\ProxmoxMGW\Endpoints\Endpoint;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\GetConfigRequest;
use Cyberfusion\ProxmoxMGW\Requests\Nodes\SetConfigRequest;
use Cyberfusion\ProxmoxMGW\Models\Nodes\NodeConfig;
use Cyberfusion\ProxmoxMGW\Support\Result;

class NodeConfigEndpoint extends Endpoint
{
    /**
     * Get node configuration options.
     *
     * @param GetConfigRequest $request
     * @return Result
     */
    public function get(GetConfigRequest $request): Result
    {
        // Implementation
    }

    /**
     * Set node configuration options.
     *
     * @param SetConfigRequest $request
     * @return Result
     */
    public function set(SetConfigRequest $request): Result
    {
        // Implementation
    }
}
