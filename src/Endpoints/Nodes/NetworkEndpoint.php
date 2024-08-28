<?php

namespace Cyberfusion\ProxmoxPVE\Endpoints\Nodes;

use Cyberfusion\ProxmoxPVE\Endpoints\Endpoint;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\CreateNetworkRequest;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\DeleteNetworkRequest;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\GetNetworkRequest;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\ReloadNetworkConfigRequest;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\RevertNetworkChangesRequest;
use Cyberfusion\ProxmoxPVE\Requests\Nodes\UpdateNetworkRequest;
use Cyberfusion\ProxmoxPVE\Models\Nodes\Network;
use Cyberfusion\ProxmoxPVE\Support\Result;

class NetworkEndpoint extends Endpoint
{
    /**
     * List available networks
     *
     * @param GetNetworkRequest $request
     * @return Result
     */
    public function get(GetNetworkRequest $request): Result
    {
        // Implementation
    }

    /**
     * Create network device configuration
     *
     * @param CreateNetworkRequest $request
     * @return Result
     */
    public function create(CreateNetworkRequest $request): Result
    {
        // Implementation
    }

    /**
     * Reload network configuration
     *
     * @param ReloadNetworkConfigRequest $request
     * @return Result
     */
    public function reloadConfig(ReloadNetworkConfigRequest $request): Result
    {
        // Implementation
    }

    /**
     * Revert network configuration changes
     *
     * @param RevertNetworkChangesRequest $request
     * @return Result
     */
    public function revertChanges(RevertNetworkChangesRequest $request): Result
    {
        // Implementation
    }

    /**
     * Read network device configuration
     *
     * @param GetNetworkRequest $request
     * @return Result
     */
    public function getConfig(GetNetworkRequest $request): Result
    {
        // Implementation
    }

    /**
     * Update network device configuration
     *
     * @param UpdateNetworkRequest $request
     * @return Result
     */
    public function update(UpdateNetworkRequest $request): Result
    {
        // Implementation
    }

    /**
     * Delete network device configuration
     *
     * @param DeleteNetworkRequest $request
     * @return Result
     */
    public function delete(DeleteNetworkRequest $request): Result
    {
        // Implementation
    }
}
