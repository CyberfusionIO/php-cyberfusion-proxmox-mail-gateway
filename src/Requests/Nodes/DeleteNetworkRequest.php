<?php

namespace Cyberfusion\ProxmoxPVE\Requests\Nodes;

class DeleteNetworkRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $iface Network interface name.
     */
    public function __construct(
        public string $node,
        public string $iface,
    ) {
    }
}
