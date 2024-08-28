<?php

namespace Cyberfusion\ProxmoxMGW\Requests\Nodes;

class SubscriptionUpdateRequest
{
    /**
     * @param string $node The cluster node name.
     * @param bool $force Always connect to server, even if we have up to date info inside local cache.
     */
    public function __construct(
        public string $node,
        public bool $force = false,
    ) {
    }
}
