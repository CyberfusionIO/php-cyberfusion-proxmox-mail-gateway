<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Apt;

class ListUpdatesRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
