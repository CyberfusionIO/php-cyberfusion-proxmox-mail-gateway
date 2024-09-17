<?php

namespace Cyberfusion\ProxmoxPVE\Requests\Nodes;

class ReloadNetworkConfigRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
