<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes\Postfix;

class FlushQueuesRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
