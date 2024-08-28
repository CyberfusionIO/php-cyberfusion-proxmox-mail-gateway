<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class SubscriptionSetRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $key Proxmox Mail Gateway subscription key
     */
    public function __construct(
        public string $node,
        public string $key,
    ) {
    }
}
