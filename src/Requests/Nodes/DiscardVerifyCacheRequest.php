<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class DiscardVerifyCacheRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
