<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class AptIndexRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
