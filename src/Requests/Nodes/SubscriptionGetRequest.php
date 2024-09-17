<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class SubscriptionGetRequest
{
    /**
     * @param string $node The cluster node name.
     */
    public function __construct(
        public string $node,
    ) {
    }
}
