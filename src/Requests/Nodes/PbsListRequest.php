<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class PbsListRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
