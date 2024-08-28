<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class ServiceStartRequest
{
    /**
     * @param string $node The cluster node name.
     * @param string $service Service ID
     */
    public function __construct(
        public string $node,
        public string $service,
    ) {
    }
}
