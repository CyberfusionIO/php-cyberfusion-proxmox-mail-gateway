<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt;

class GetRepositoriesRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
