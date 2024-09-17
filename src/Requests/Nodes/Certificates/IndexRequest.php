<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Certificates;

class IndexRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
